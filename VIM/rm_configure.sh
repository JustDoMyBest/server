#!/usr/bin/bash

if [[ -d ~/.vim_runtime ]]
then
    rm -rf ~/.vim_runtime
    echo '.vim_runtime removed'
fi

if [[ -e ~/.vimrc ]]
then
    rm -f ~/.vimrc
    echo '.vimrc removed'
fi

if [[ -e ~/.viminfo ]]
then
    rm -f ~/.viminfo
    echo '.viminfo removed'
fi

if [[ -e ~/.vim_mru_files ]]
then
    rm -f ~/.vim_mru_files
    echo '.vim_mru_files removed'
fi

find $HOME -name *vimrc_bak* -print0|xargs -0 rm -rf&&echo '.vimrc_bak_H:M:S and vimrc_bak_record.log all removed'

