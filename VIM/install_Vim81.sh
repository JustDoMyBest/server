#!/usr/bin/bash

if test "`python3 --version 2>&1|awk '{print $2}'|awk -F '.' '{print $1}'`" -ne 3
then
    echo 'Require install python3'
    exit
fi

sudo yum install -y ruby ruby-devel lua lua-devel luajit \
luajit-devel ctags git python python-devel \
tcl-devel \
perl perl-devel perl-ExtUtils-ParseXS \
perl-ExtUtils-XSpp perl-ExtUtils-CBuilder \
perl-ExtUtils-Embed
sudo ln -s /usr/bin/xsubpp /usr/share/perl5/ExtUtils/xsubpp

tar -xjvf vim-8.1.tar.bz2

cd vim81
./configure --with-features=huge \
	    --enable-multibyte \
	    --enable-rubyinterp=yes \
	    --enable-pythoninterp=yes \
	    --enable-python3interp=yes \
	    --enable-perlinterp=yes \
	    --enable-luainterp=yes \
            --enable-gui=gtk2 \
            --enable-cscope \
	   --prefix=/usr/local/vim81 && make VIMRUNTIMEDIR=/usr/local/vim81/share/vim/vim81 && make install && ln -s /usr/local/vim81/bin/vim /usr/local/bin
cd ..
