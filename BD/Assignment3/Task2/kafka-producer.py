#!/usr/bin/env python3

from kafka import KafkaProducer  
from sys import argv, stdin
from csv import reader

producer = KafkaProducer()  
data = stdin.readlines()

for content in reader(data):  
    if content[0]=="EOF":
        producer.send(argv[1], content[0].encode())
        break
    else:
        info=[content[0], float(content[6]), float(content[7])]
        info=str(info)
        producer.send(argv[1], info.encode())
producer.flush()