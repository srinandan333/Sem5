import socket
from _thread import start_new_thread
from json import dump, load 

def multi_threaded_client(conn, type, topic, addr):
    if topic not in topic_conn.keys():
        topic_conn[topic] = []
    topic_conn[topic].append(conn)

    type_conn[type].append(conn)
    temp = conn

    if topic not in topic_msg.keys():
        topic_msg[topic] = []

    if type == "prod":
        while True:
            conn = temp
            msg = conn.recv(1024).decode()
            if not msg:
                break
            log.write("Received message from:"  + addr[0] + " : " + str(addr[1]) + "\n")
            conn.send(bytes("ACK", "utf-8")) 
            log.write("Sent acknowledgment to:"  + addr[0] + " : " + str(addr[1]) + "\n")

            if topic not in topic_msg.keys():
                topic_msg[topic] = []
            topic_msg[topic].insert(0, msg)

            for conn in topic_conn[topic]:
                if (conn in type_conn["cons"] or conn in type_conn["cons-fb"]):
                    conn.send(bytes(msg, "utf-8"))
                    log.write("Sent message to:"  + addr[0] + " : " + str(addr[1]) + "\n")
                    ack = conn.recv(1024).decode()  
                    log.write("Received acknoqledgement from:"  + addr[0] + " : " + str(addr[1]) + "\n")

    elif type == "cons-fb":
        arr = topic_msg[topic]
        for i in range(len(arr)-1, -1, -1):
            msg = arr[i]
            conn.send(bytes(msg, "utf-8"))
            log.write("Sent message to:"  + addr[0] + " : " + str(addr[1]) + "\n")
            ack = conn.recv(1024).decode()  
            log.write("Received acknowledgement from:"  + addr[0] + " : " + str(addr[1]) + "\n")

if __name__ == "__main__":
    zkpr = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    zkpr.connect(("127.0.0.1", 9092))
    print("Broker...")

    client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    client.bind(("127.0.0.1", 9095))
    client.listen(5)

    num_prod = 0
    num_cons = 0

    topic_conn = dict()
    type_conn = dict()

    with open("topics.json", "r") as infile:
        topic_msg = load(infile)
    log = open("logs.txt", "a")

    type_conn["prod"] = []
    type_conn["cons"] = []
    type_conn["cons-fb"] = []

    while True:
        poll = zkpr.recv(1024).decode()
        log.write("Received poll from zookeeper:" + poll + "\n")
        beat = "BEAT"
        zkpr.send(bytes(beat,"utf-8"))
        log.write("Sent heartbeat to zookeeper:" + beat + "\n")
        if poll == "3":
            break

    while True:
        try:
            poll = zkpr.recv(1024).decode()
            log.write("Received poll from zookeeper:" + poll + "\n")
            zkpr.send(bytes("BEAT","utf-8"))
            log.write("Sent heartbeat to zookeeper:" + beat + "\n")
                    
            conn, addr = client.accept()
            print("Connected to: " + addr[0] + " : " + str(addr[1]))
            log.write("Connected to: " + addr[0] + " : " + str(addr[1]) + "\n")

            type = conn.recv(1024).decode()
            print("Type:", type)
            log.write("Received type from:"  + addr[0] + " : " + str(addr[1]) + "\n")
            conn.send(bytes("ACK", "utf-8"))
            log.write("Sent acknowledgment to:"  + addr[0] + " : " + str(addr[1]) + "\n")

            topic = conn.recv(1024).decode()
            print("Topic:", topic)
            log.write("Received topic from:"  + addr[0] + " : " + str(addr[1]) + "\n")
            conn.send(bytes("ACK", "utf-8"))
            log.write("Sent acknowledgment to:"  + addr[0] + " : " + str(addr[1]) + "\n")

            start_new_thread(multi_threaded_client, (conn, type, topic, addr))

            if type == "prod":
                num_prod += 1
            elif type == "cons" or type == "cons-fb":
                num_cons += 1

            print("Number of producers: " + str(num_prod))
            log.write("Number of producers: " + str(num_prod) + "\n")
            print("Number of consumers: " + str(num_cons))
            log.write("Number of consumers: " + str(num_cons) + "\n")

            with open("topics.json", "w") as outfile:
                dump(topic_msg, outfile, indent = 4)

        except KeyboardInterrupt:
            with open("topics.json", "w") as outfile:
                dump(topic_msg, outfile, indent = 4)

            print("Broker 3 failed...")
            log.write("Broker 3 failed...")
            
            log.close()
            exit()