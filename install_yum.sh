#!/usr/bin/bash

ISO_dir='CentOS-7-x86_64-Everything-1804.iso'
epel_release_rpm_dir='epel-release-latest-7.noarch.rpm'
c7_media_dir='/media/cdrom'
yum_repo_d_dir='/etc/yum.repo.d'

mkdir -p $yum_repo_d_dir/repo_bak
mv $yum_repo_d_dir/*.repo $yum_repo_d_dir/repo_bak
mv $yum_repo_d_dir/repo_bak/CentOS-Media.repo $yum_repo_d_dir
mount -o loop $ISO_dir $c7_media_dir
echo "mount -o loop $ISO_dir $c7_media_dir" >> /root/.bashrc

yum install yum-plugin-priorities -y
echo 'priority=1' >> $yum_repo_d_dir/CentOS-Media.repo

yum install $epel_release_rpm_dir -y
yum clean all
yum makecache
