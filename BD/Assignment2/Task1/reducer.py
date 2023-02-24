#!/usr/bin/env python3

import sys

file_name=sys.argv[1]
pres_node=None
node_arr=[]

if __name__=="__main__":
    page_rank=open(file_name, "w")
    for content in sys.stdin:
        content=content.strip()
        from_node,to_node=content.split(",",1)
        from_node=int(from_node.strip())
        to_node=int(to_node.strip())
        if(pres_node==None):
            print(f"{from_node}\t[{to_node}", end="")
            page_rank.write(f"{from_node},1\n")
            pres_node=from_node
        else:
            if(pres_node==from_node):
                print(f", {to_node}", end="")
            else:
                print("]")
                print(f"{from_node}\t[{to_node}", end="")
                page_rank.write(f"{from_node},1\n")
                pres_node=from_node
    print(f"]")