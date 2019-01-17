#!/usr/bin/bash

#/usr/bin/time -f "start:`date` \truntime:%E  file:hs_code_get_data  " /usr/bin/wget -q   --spider http://127.0.0.1:9192/task/hs_code_get_data.php >> /root/log/log.txt 2>&1

count=1
for i in $(seq 1 12000)
do
        /usr/bin/time -f "start:`date` \truntime:%E  file:hs_code_get_data_port_9192_count_12000_${count}  " /usr/bin/wget -q   --spider http://127.0.0.1:9192/task/hs_code_get_data.php >> /root/log/log.txt 2>&1
	let count=$count+1
done
