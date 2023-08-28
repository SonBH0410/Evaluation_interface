#!/bin/bash
import sys
import os
if __name__ == '__main__':
    cap=sys.argv[1]   
    camList = sys.argv[2]
    fromTime = sys.argv[3]
    toTime = sys.argv[4]
    cmd = "cd /home/nhquan;. /home/nhquan/timkiemnguoi_env/bin/activate;cd /home/nhquan/works/VitaaIntergrate_v2.0/;python3 intergrate/main.py --config-file configs/cuhkpedes/bilstm_r50_seg.yaml --checkpoint-file output/cuhkpedes/epoch_final-un.pth --caption '%s' --cam-list '%s' --from-time '%s' --to-time '%s';"%(cap, camList, fromTime, toTime)
    os.system(cmd)
