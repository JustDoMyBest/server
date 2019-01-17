#!/bin/bash

for i in `seq 1 800`
do
	/usr/bin/time -f "start:`date` \truntime:%E  file:tmp_port_9192_count_800  " /usr/bin/wget -q   --spider http://127.0.0.1:9192/script/store/updatestoreAll >> /root/log/log.txt 2>&1
done
