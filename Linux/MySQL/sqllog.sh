#!/bin/bash
# Program:
#       此程序用于定时切割mysql的慢查询日志！
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:/usr/local/mariadb/bin
export PATH
slowlog=/usr/local/mariadb/var/localhost-slow.log
mv $slowlog /home/sqllog/slow.`date +%Y%m%d%H`.log
mysqladmin -uroot -pgoj355 --socket=/tmp/mysql.sock flush-logs

