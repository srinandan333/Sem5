#!/usr/bin/env python3
import sys
import json

D = float(sys.argv[1].strip())
LATITUDE=float(sys.argv[2].strip())
LONGITUDE=float(sys.argv[3].strip())


for i in sys.stdin:
    i = i.strip()
    info = json.loads(i)
    if info["humidity"] > 48 and info["humidity"] < 54 and info["humidity"]!="NaN":
                    if info["temperature"] > 20 and info["temperature"]< 24 and info["temperature"]!="NaN":
                    	if info["lat"]!="NaN" and info["lon"]!="NaN":
                    		date = info["timestamp"]
                    		distance=(((info["lat"]-LATITUDE)**2) + ((info["lon"]-LONGITUDE)**2))**(0.5)
                    		if distance < D:
                    			print(f"{date}\t1")




