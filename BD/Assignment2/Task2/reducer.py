#!/usr/bin/env python3
from sys import stdin

pres_node = None
sum_contr = 0
page_node = None

for content in stdin:
    content = content.strip()
    page_node, page_contr = content.split('\t')
    page_node = int(page_node)
    page_contr = float(page_contr)
    
    if page_node == pres_node:
        sum_contr += page_contr
    else:
        if pres_node!=None:
            page_rank = 0.34 + (0.57 * sum_contr)
            print(f"{pres_node},{page_rank:.2f}")

        sum_contr = page_contr 
        pres_node = page_node

if pres_node == page_node:
    page_rank = 0.34 + (0.57 * sum_contr)
    print(f"{pres_node},{page_rank:.2f}")