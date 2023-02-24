#!/usr/bin/env python3

import sys
import json

for i in sys.stdin:
    i = i.strip()
    info = json.loads(i)
    if info["location"] > 1700 and info["location"] < 2500:
        if info["sensor_id"] < 5000:
            if info["pressure"] >= 93500.00:
                if info["humidity"] >= 72.00:
                    if info["temperature"] >= 12.00:
                        date = info["timestamp"]
                        print(f"{date},1")
