#!/bin/bash
#cd /home/nhquan
source /home/nhquan/timkiemnguoi_env/bin/activate
cd /home/nhquan/works/VitaaIntergrate_v2.0/
python3 intergrate/main.py --config-file configs/cuhkpedes/bilstm_r50_seg.yaml \
			--checkpoint-file output/cuhkpedes/epoch_final-un.pth \
			--caption "Một người phụ nữ mặc áo khoác màu cam, quần màu đen, đầu đội mũ" \
			--cam-list "cam01,cam02" \
			--from-time "20220109-0000" \
			--to-time "20220109-2359"