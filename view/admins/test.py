#!/bin/bash
import sys
import os
if __name__ == '__main__':
    cap = sys.argv[1]
    max_result = 30 #sys.argv[2]
    cmd = ". /home/nhquan/timkiemnguoi_env/bin/activate;cd /home/nhquan/works/VitaaIntergrate/;python3 intergrate/main.py --config-file configs/cuhkpedes/bilstm_r50_seg.yaml --checkpoint-file output/cuhkpedes/epoch_final-un.pth --caption '%s' --max-result %d;"%(cap,max_result)
    os.system(cmd)
 