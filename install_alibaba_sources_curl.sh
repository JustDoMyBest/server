#!/usr/bin/bash

read -p 'please input linux release version
(
CentOS7; 1
Debian9: 2
CentOS6: 3
Debian8: 4
):' version


yum_repos_d_dir='/etc/yum.repos.d'
apt_sources_list='/etc/apt/sources.list'

HOME='/root'

# mv /etc/yum.repos.d/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo.backup

# CentOS backup
if test -e $yum_repos_d_dir
then
    # if test ! -e $yum_repos_d_dir'/repo_bak'
    # then
    #     mkdir -p $yum_repos_d_dir/repo_bak
    # fi

    # if test -e $yum_repos_d_dir'/repo_bak/CentOS-Base.repo'
    # then
    #     exit
    # fi

    mkdir -p "$yum_repos_d_dir/repos_bak_$(date '+%Y%m%d_%H:%M:%S')"
    mv $yum_repos_d_dir/*.repo "$yum_repos_d_dir/repos_bak_$(date '+%Y%m%d_%H:%M:%S')"
fi

# Debian backup
if test -e $apt_sources_list
then
    mv $apt_sources_list $apt_sources_list'.backup.'$(date '+%Y%m%d_%H:%M:%S')
fi

case "$version" in
    1)
        curl -o /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-7.repo
        yum remove epel-release -y
        curl -o /etc/yum.repos.d/epel.repo http://mirrors.aliyun.com/repo/epel-7.repo
        ;;
    2)
        echo 'deb http://mirrors.aliyun.com/debian/ stretch main non-free contrib
deb-src http://mirrors.aliyun.com/debian/ stretch main non-free contrib
deb http://mirrors.aliyun.com/debian-security stretch/updates main
deb-src http://mirrors.aliyun.com/debian-security stretch/updates main
deb http://mirrors.aliyun.com/debian/ stretch-updates main non-free contrib
deb-src http://mirrors.aliyun.com/debian/ stretch-updates main non-free contrib
deb http://mirrors.aliyun.com/debian/ stretch-backports main non-free contrib
deb-src http://mirrors.aliyun.com/debian/ stretch-backports main non-free contrib' >> $apt_sources_list
        ;;
    3)
        curl -o /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-6.repo
        yum remove epel-release -y
        curl -o /etc/yum.repos.d/epel.repo http://mirrors.aliyun.com/repo/epel-6.repo
        ;;
    4)
        echo 'deb http://mirrors.aliyun.com/debian/ jessie main non-free contrib
deb http://mirrors.aliyun.com/debian/ jessie-proposed-updates main non-free contrib
deb-src http://mirrors.aliyun.com/debian/ jessie main non-free contrib
deb-src http://mirrors.aliyun.com/debian/ jessie-proposed-updates main non-free contrib' >> $apt_sources_list
        ;;
    *)
        echo 'now only 1 2 3 4 can be inputed'
        exit
        ;;
esac

# yum install yum-plugin-priorities -y
# sed -i 's/enabled=0/enabled=1/g' $yum_repos_d_dir/CentOS-Base.repo
# grep 'priority=2' $yum_repos_d_dir/CentOS-Base.repo
# if [ ! $? -eq 0 ]
# then
#     echo 'priority=2' >> $yum_repos_d_dir/CentOS-Base.repo
# fi

# yum remove epel-release -y
#yum install epel-release -y
yum clean all
yum makecache




########
# pypi #
########
if test ! -e ~/.pip/pip.conf
then
    mkdir -p ~/.pip
    echo '[global]
index-url = https://mirrors.aliyun.com/pypi/simple/

[install]
trusted-host=mirrors.aliyun.com' >> ~/.pip/pip.conf
fi
