#!/bin/bash

PATH=/bin:/usr/bin:/usr/local/bin

if [ $# -eq 0 ]
then
	line_num=20
else
	line_num=$1
fi

IFS_BAK=$IFS
IFS=$'\n'
real_time_1_9=(`cat /root/log/log.txt|grep 'runtime:[1-9]'|sort -rn -k5 -k6 -t ':'|head -n $line_num`)

for item in ${real_time_1_9[@]}
do
	echo $item|awk -F ':' '{print $NF}' >> tmp
done

real_time_1_9_files=(`cat tmp`)
rm tmp

count=0
for item in ${real_time_1_9[@]}
do
	echo $item
	grep ${real_time_1_9_files[count]} /var/spool/cron/root >> tmp
	tmp=`cat tmp`
	rm tmp
	echo $tmp
	echo 
	let count=count+1
done
