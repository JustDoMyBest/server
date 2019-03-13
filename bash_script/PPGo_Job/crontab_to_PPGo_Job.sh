#!/usr/bin/bash
PATH=/usr/lib64/qt-3.3/bin:/root/perl5/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/usr/local/go/bin:/root/.local/bin:/root/bin:/home/wwwroot/oms.ejbuy.com/ejworkbench/golang/bin
export PATH

# MYSQL="mysql -h10.3.0.248 -uroot -pgoj355 --default-character-set=utf8 -A -N"
MYSQL="mysql -h10.3.0.225 -uroot -padminpw123 --default-character-set=utf8 -A -N"
#MYSQL="mysql --version"
#sql="select * from OMS.ej_task"

# 225
# server_id=1
# group_id=3
# 225

# 248
# server_id=2
# group_id=1
# 248

if [ -z $group_id -o -z $server_id ]
then
    echo "Before execute this script£¬must set group_id and server_id."
    exit
fi

IFS_BAK=$IFS
IFS=$'\n'
time_array=(`cat time_ep_list.tmp`)
cmd_array=(`cat cmd_list.tmp `)
#IFS=$IFS_BAK
i=0
while [ $i -lt ${#time_array[@]} ]
do
    status=0
    create_id=1
    date=$(date +"%s")
    cron_spec="0 ${time_array[i]}"
    command=${cmd_array[i]}
    task_name=`echo $command | grep -oP '[^\/]*\.(php|sh)'`
    # echo $command
    # echo $task_name
    description=$task_name
 #    sql="insert into OMS.ej_task(group_id,server_id,task_name,description,cron_spec,command,status,create_time,create_id,update_time)
 # values(${group_id},${server_id},'${task_name}','${description}','${cron_spec}','${command}','${status}','${date}','${create_id}','${date}');"
    sql="insert into ppgo_job2.ej_task(group_id,server_id,task_name,description,cron_spec,command,status,create_time,create_id,update_time)
 values(${group_id},${server_id},'${task_name}','${description}','${cron_spec}','${command}','${status}','${date}','${create_id}','${date}');"
    # echo $sql
    IFS=$IFS_BAK
    $MYSQL -e "$sql"
    IFS=$'\n'
    ((i++))
    sleep 0
done


# cat time_ep_list.tmp  | while read cron_spec
# do
#     status=0
#     create_id=1
#     date=$(date +"%s")
#     cron_spec=$cron_spec
#     sql="insert into OMS.ej_task(group_id,server_id,task_name,description,cron_spec,command,status,create_time,create_id,update_time)
# values(3,1,'${task_name}','${description}','${cronspec}','${command}','${status}','${date}','${create_id}','${date}')"
#     result="$($MYSQL -e "$sql")"
# done


# cat cmd_list.tmp | while read command
# do
#     command=
#     task_name=
#     description=$task_name
#     sql="update OMS.ej_task set (group_id,server_id,task_name,description,cron_spec,command,status,create_time,create_id,update_time)
# values(3,1,'${task_name}','${description}','${cronspec}','${command}','${status}','${date}','${create_id}','${date}')"
#         result="$($MYSQL -e "$sql")"
# done


# echo "$result"
