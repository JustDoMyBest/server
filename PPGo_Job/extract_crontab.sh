#!/usr/bin/bash
PATH=/usr/lib64/qt-3.3/bin:/root/perl5/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/usr/local/go/bin:/root/.local/bin:/root/bin:/home/wwwroot/oms.ejbuy.com/ejworkbench/golang/bin
export PATH
# time_ep_list=$(cat /var/spool/cron/root|grep -v '^$' |grep -v '#'|grep -oE '[\/\*0-9\,\-]+ [\/\*0-9\,\-]+ [\/\*0-9\,\-]+ [\/\*0-9\,\-]+ [\/\*0-9\,\-]+')
time_ep_list=$(IFS=$"\r\n";cat /var/spool/cron/root|grep -v '^$' |grep -v '#'|grep -oP '.*\*(?= |\t)')
cmd_list=$(IFS=$"\r\n";cat /var/spool/cron/root|grep -v '^$' |grep -v '#'|grep -oE '\/?[[:alpha:]].*|'|sed "s/'/\\\'/g")

IFS_BAK=$IFS
IFS=$'\n'
time_ep_list=(${time_ep_list//\n/})
cmd_list=($cmd_list)
IFS=$IFS_BAK
#declare -p time_ep_list
#declare -p cmd_list

printf "%s\n" "${time_ep_list[@]}" >> time_ep_list.tmp
printf "%s\n" "${cmd_list[@]}" >> cmd_list.tmp


# a='123
# 456
# 789'

# declare -p a

# IFS=$'\n'
# a=(${a//\n/})
# declare -p a
