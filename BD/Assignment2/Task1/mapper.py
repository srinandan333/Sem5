#!/usr/bin/env python3

from sys import stdin

if __name__=="__main__":
    for content in stdin:
        if content[0]!="#":
            content=content.strip()
            from_node,to_node=content.split("\t",1)
            print(f"{from_node},{to_node}")