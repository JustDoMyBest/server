#!/usr/bin/bash

year=`date +%Y`
month=`date +%m`
day=`date +%d`
flag=abnormal
vimrc_bak_record_path=~/bak_record

operate(){
    if [[ -e ~/.vimrc ]]
    then
        mv $HOME/.vimrc "$HOME/$year/$month/$day/.vimrc_bak_`date +'%H:%M:%S'`"
    fi
    tar -xjvf .vim_runtime.tar.bz2 -C $HOME
    flag=normal
}

if [[ ! -d ~/$year/$month/$day ]]
then
    mkdir -p ~/$year/$month/$day
    operate
else
    operate
fi

if [[ ! -d $vimrc_bak_record_path ]]
then
    mkdir -p $vimrc_bak_record_path
fi

echo "$year$month$day:$flag" >> $vimrc_bak_record_path/vimrc_bak_record.log
