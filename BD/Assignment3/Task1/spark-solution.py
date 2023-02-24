#!/usr/bin/env python3

from pyspark.sql import SparkSession
from sys import argv

if __name__ == '__main__':
    spark = SparkSession.builder \
        .master("yarn") \
        .appName("BDA3") \
        .getOrCreate()
    data = spark.read.csv(argv[1], header=True, inferSchema=True)
    data = data.dropDuplicates(["Ticket number"])
    data = data.dropna()
    temp = data.groupBy("RP State Plate").avg("Fine Amount")
    temp = data.join(temp, on = ["RP State Plate"], how="inner")
    temp = temp.filter(temp["Fine Amount"] > temp["avg(Fine Amount)"])
    temp = temp.filter(temp.Color == "WH")
    temp = temp.orderBy("Ticket number")
    res = temp.select("Ticket number")
    res.write.csv(argv[2])
    spark.stop()