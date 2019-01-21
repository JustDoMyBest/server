#!/bin/bash


user=root
passwd=''
file="/etc/my.cnf"
name=`date +"%Y%m%d"`
script_dir=/home/s/bash_script

if test ! -d /home/sqlbackup/
then
	cd $script_dir
	./mk_sqlback_dir.sh

	echo start: `date` >> /home/sqlbackup/log/log.txt
	cd /home/sqlbackup/data/
	innobackupex --defaults-file=$file --user=$user  --password=$passwd  --stream=tar ./  | pigz - > $name.tar.gz
	echo finished: `date` >> /home/sqlbackup/log/log.txt

	exit
fi


mv /home/sqlbackup/data/*  /home/sqlbackup/tmp

	echo start: `date` >> /home/sqlbackup/log/log.txt
cd /home/sqlbackup/data/

innobackupex --defaults-file=$file --user=$user  --password=$passwd  --stream=tar ./  | pigz - > $name.tar.gz
	echo finished: `date` >> /home/sqlbackup/log/log.txt


rm -f  /home/sqlbackup/tmp/*




