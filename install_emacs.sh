#!/usr/bin/bash

HOME='/root'
emacs_tgz_dir='emacs-25.1.tar.gz'
emacs_installed_dir='/usr/local/emacs-25.1'
emacs_src_dir='emacs-25.1'

emacs_conf_tgz_dir='.emacs.d.tgz'


if [ -d $emacs_installed_dir ]
then
    echo 'emacs is installed.'
    exit
fi

read -p '请输入用户主目录（默认为“/root”）：' HOME
#echo $HOME
if [ -z $HOME ]
then
    HOME='/root'
fi
#echo $HOME

#yum -y install libXpm-devel libjpeg-turbo-devel openjpeg-devel openjpeg2-devel turbojpeg-devel giflib-devel libtiff-devel gnutls-devel libxml2-devel GConf2-devel dbus-devel wxGTK-devel gtk3-devel
#yum -y install libXpm-devel libjpeg-turbo-devel openjpeg libjpeg-turbo-devel giflib libtiff-devel gnutls-devel libxml2-devel GConf2 dbus-devel gtk3-devel
yum -y install gcc make ncurses-devel giflib-devel libjpeg-devel libtiff-devel
#yum deplist emacs|awk '/provider:/{print $2}' |xargs -n1 yum -y install
#apt-get build-dep emacs24

if [ -f $emacs_tgz_dir ]
then
    echo '正在解压'$emacs_tgz_dir
    tar -xf $emacs_tgz_dir -C .
fi

cd $emacs_src_dir
#./configure --prefix=$emacs_installed_dir --with-x-toolkit=no --with-gif=no --with-tiff=no && make && make install
./configure --prefix=$emacs_installed_dir --without-x --without-selinux && make && sudo make install
#./configure && make && sudo make install
cd ..


if [ -e $emacs_conf_tgz_dir ]
then
    echo '正在解压'$emacs_conf_tgz_dir
    tar -C $HOME -xf $emacs_conf_tgz_dir
fi


grep 'TERM=xterm-256color' $HOME/.bashrc > /dev/null
if [ ! $? -eq 0 ]
then
    echo 'export TERM=xterm-256color'  >> $HOME/.bashrc
    # source $HOME/.bashrc
    # export TERM=xterm-256color
fi

ln -s $emacs_installed_dir/bin/emacs /usr/local/bin
