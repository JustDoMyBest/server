#!/usr/bin/bash

#tmp_file='/root/s/tmp/tmp.sh'
tmp_file='tmp.sh'

if [ ! -e /root/s/tmp ]
then
    mkdir -p '/root/s/tmp'
fi

echo '#!/usr/bin/bash' > $tmp_file
ls /sys/class/scsi_host/host*/scan|xargs -n1 echo "echo '- - -' >" >> $tmp_file
cat $tmp_file
chmod 0755 $tmp_file
bash $tmp_file
