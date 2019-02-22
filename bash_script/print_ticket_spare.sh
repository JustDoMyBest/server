#!/usr/bin/bash

script_original_name=/home/wwwroot/oms.ejbuy.com/ejworkbench/print_ticket_spare
log_dir=/home/wwwroot/oms.ejbuy.com/ejworkbench/bash_log
log_name=print_ticket_spare.log
#script_name=${script_original_name}_`date +'%s'`.sh

while true
do
	sleep 1
	#script_name=${script_original_name}_`date +'%s'`_`/usr/bin/openssl rand -base64 8|md5sum|cut -c 1-20`.sh
	script_name=${script_original_name}_`date +'%Y%m%d_%H:%M:%S'`_`/usr/bin/openssl rand -base64 8|md5sum|cut -c 1-20`.sh
#	echo 2
	if test -e ${script_original_name}.sh
	then
		mv ${script_original_name}.sh $script_name
		if test ! -e ${log_dir}
		then
			mkdir ${log_dir}
		fi
		#/usr/bin/time -f "start:`date` \truntime:\%E  file:print_ticket_spare  " echo ${script_name}__`date +'%Y%m%d-%H:%M:%S'` >> ${log_dir}${log_name}
		/usr/bin/time -f "start:`date` \truntime:%E  file:print_ticket_spare  " /usr/bin/bash $script_name &>> ${log_dir}/${log_name}
	fi
done

#script_name=/home/wwwroot/oms.ejbuy.com/ejworkbench/print_ticket_spare_`date +'%s'`.sh
#echo $script_name
#mv /home/wwwroot/oms.ejbuy.com/ejworkbench/print_ticket_spare.sh /home/wwwroot/oms.ejbuy.com/ejworkbench/print_ticket_spare_`date +'%s'`.sh

#mv /home/wwwroot/oms.ejbuy.com/ejworkbench/print_ticket_spare.sh $script_name
#echo $script_name
#command -v bash $script_name
