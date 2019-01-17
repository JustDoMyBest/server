#!/bin/bash
HOST='10.3.0.226'
USER='linjiaming'
PASSWD='linjiaming2266li'
FILE='test.txt'

ftp -n $HOST <<BLAH
quote USER $USER
quote PASS $PASSWD
bin
get $FILE
quit
BLAH
exit 0
