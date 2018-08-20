#/bin/bash
log_path=/root/log
year=`date +%Y`
month=`date +%m`
day=`date +%d`
flag=abnormal
log_split_record_path=root_log_split

operate(){
   mv $log_path/log.txt "$log_path/$year/$month/$day/log`date +'%H: %M: %S'`.txt"
#   kill -USR1 $(cat /usr/local/nginx/logs/nginx.pid)
   flag=normal
}

if [[ ! -d $log_path/$year/$month/$day ]]
then
  mkdir -p  $log_path/$year/$month/$day
  operate
else
  operate
fi

if [ ! -d $log_path/$log_split_record_path ]
then
    mkdir -p $log_path/$log_split_record_path
fi

if [[ $flag == "normal" ]]
then
    echo "$year$month$day:$flag" >> $log_path/$log_split_record_path/split_log.txt
else
    echo "$year$month$day:$flag" >> $log_path/$log_split_record_path/split_log.txt
fi
