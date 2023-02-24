#!/usr/bin/env python3

from json import dumps
from kafka import KafkaConsumer
from sys import argv
 
consumer = KafkaConsumer(argv[1])
result=dict()
count=dict()

for content in consumer:
    content=content.value.decode()
    if content=="EOF":
        break

    info=content[1:-1].split(",")
    key=info[0][1:-1]
    val1=float(info[1].strip())
    val2=float(info[2].strip())
    
    if key not in result.keys():
        result[key]=dict()
        result[key]["Min"]=val1
        result[key]["Max"]=val2
        count[key]=1
    else:
        result[key]["Min"]+=val1
        result[key]["Max"]+=val2
        count[key]+=1

for key in result.keys():
    result[key]["Min"]=round(result[key]["Min"]/count[key], 2)
    result[key]["Max"]=round(result[key]["Max"]/count[key], 2)

print(dumps(result,indent = 4,sort_keys=True))