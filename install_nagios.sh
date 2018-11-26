#!/usr/bin/bash

read -p 'please input linux release version
(
CentOS7; 1
Debian9: 2
CentOS6: 3
Debian8: 4
):' version

prefix='/usr/local/nagios-4.4.2'
Nagios_Core_version='4.4.2'

CentOS_install_Nagios() {
    sed -i 's/SELINUX=.*/SELINUX=disabled/g' /etc/selinux/config
        setenforce 0

        yum install -y gcc glibc glibc-common wget unzip httpd php gd gd-devel perl postfix
        ls ./*\.gz|xargs -n1 tar -xvf
}

CentOS_install_Nagios_Plugins(){
    # Prerequisites
    # yum install -y gcc glibc glibc-common make gettext automake autoconf wget openssl-devel net-snmp net-snmp-utils epel-release
    yum install -y gcc glibc glibc-common make gettext automake autoconf wget openssl-devel net-snmp net-snmp-utils
    yum install -y perl-Net-SNMP

    cd nagios-plugins-2.2.1
    ./configure --prefix=$prefix && make && make install
    cd ..
}

case $version in
    # CentOS7
    1)
        CentOS_install_Nagios

        cd nagios-$Nagios_Core_version
        ./configure --prefix=$prefix
        make all
        make install-groups-users
        usermod -a -G nagios apache
        make install

        make install-daemoninit
        systemctl enable httpd.service

        make install-commandmode
        make install-config
        make install-webconf
        cd ..


        firewall-cmd --zone=public --add-port=80/tcp
        firewall-cmd --zone=public --add-port=80/tcp --permanent
        /usr/bin/htpasswd -c $prefix/etc/htpasswd.users nagiosadmin


        systemctl start httpd.service

        systemctl start nagios.service

        ## Nagios_Plugins
        CentOS_install_Nagios_Plugins
        ;;

    # CentOS6
    3)
        CentOS_install_Nagios

        cd nagios-$Nagios_Core_version
        ./configure --prefix=$prefix
        make all
        make install-groups-users
        usermod -a -G nagios apache
        make install

        make install-daemoninit
        chkconfig --level 2345 httpd on

        make install-commandmode
        make install-config
        make install-webconf
        cd ..

        iptables -I INPUT -p tcp --destination-port 80 -j ACCEPT
        service iptables save
        ip6tables -I INPUT -p tcp --destination-port 80 -j ACCEPT
        service ip6tables save
        /usr/bin/htpasswd -c $prefix/etc/htpasswd.users nagiosadmin

        service httpd start

        service nagios start

        ## Nagios_Plugins
        CentOS_install_Nagios_Plugins
        ;;
    *)
        echo 'now only 1 3 can be inputed'
        ;;
esac
