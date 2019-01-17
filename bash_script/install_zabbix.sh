#!/usr/bin/bash


yum remove libxml2-devel
yum install libxml2-devel

tar -zxvf zabbix-4.0.0.tar.gz

groupadd zabbix
useradd -g zabbix zabbix

cd zabbix-4.0.0
./configure --prefix=/usr/local/zabbix --enable-server --enable-agent --with-mysql --enable-ipv6 --with-net-snmp --with-libcurl --with-libxml2
make install
cd ..
