#!/bin/bash


user=root
passwd=''
file="/etc/my.cnf"
name=`date +"%Y%m%d"`


mv /home/sqlbackup/data/*  /home/sqlbackup/tmp

cd /home/sqlbackup/data/

innobackupex --defaults-file=$file --user=$user  --password=$passwd  --stream=tar ./  | gzip - > $name.tar.gz


rm -f  /home/sqlbackup/tmp/*




