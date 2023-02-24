#!/usr/bin/env python3

from json import load
from sys import stdin
from sys import argv
from math import pow
from math import sqrt

def func_simil(vec_p, vec_q):
    term_p=0
    term_q=0
    mult=0
    
    kernel_size=3
    no_of_vec=len(vec_p)
    bound=no_of_vec-kernel_size+1
    i=0

    while(i<bound):
        mult+=vec_p[i]*vec_q[i]
        mult+=vec_p[i+1]*vec_q[i+1]
        mult+=vec_p[i+2]*vec_q[i+2]

        term_p+=pow(vec_p[i], 2)
        term_p+=pow(vec_p[i+1], 2)
        term_p+=pow(vec_p[i+2], 2)

        term_q+=pow(vec_q[i], 2)
        term_q+=pow(vec_q[i+1], 2)
        term_q+=pow(vec_q[i+2], 2)
        i=i+kernel_size

    result=mult/(term_p+term_q-mult)
    return result    
    
if __name__=='__main__':
    file_name=argv[1]
    file=open(file_name,"r")
    page_embed=argv[2]
    page_rank=dict()
    
    for content in file.readlines():
        content=content.strip()
        page,rank=content.split(",")
        page_rank[page]=float(rank)

    embed_file=open(page_embed,"r") 
    vectors=load(embed_file)

    for content in stdin:
        content=content.strip()
        pres_node,node_arr=content.split("\t",1)
        
        try:
            node_arr=node_arr[1:-1].split(",")
            node_arr=[int(x) for x in node_arr]
            pres_node=int(pres_node)
        except ValueError:
            continue

        print(f"{pres_node}\t0")
        page_contr1=page_rank[str(pres_node)]/len(node_arr)

        for page_node in node_arr:
            if pres_node==page_node:
                simil=1
            else:
                simil=func_simil(vectors[str(pres_node)],vectors[str(page_node)])
            page_contr=page_contr1*simil
            print(f"{page_node}\t{page_contr}")