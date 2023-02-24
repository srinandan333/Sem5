#!/usr/bin/env python3

import sys

info = dict()

for content in sys.stdin:
    content = content.strip()
    key, value = content.rsplit(",", 1)
    if key in info.keys():
        info[key] += 1
    else:
        info[key] = 1

for x in sorted(info.keys()):
    print(f"{x} {info[x]}")
