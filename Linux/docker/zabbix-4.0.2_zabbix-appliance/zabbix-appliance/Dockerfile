FROM zabbix/zabbix-appliance:centos-4.0.2
#ADD . /code

# RUN sed -i 's/archive.ubuntu.com/mirrors.aliyun.com/g' /etc/apt/sources.list
# RUN sed -i 's/security.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list
# RUN sed -i 's/deb.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list
# RUN sed -i 's/cdn-fastly.deb.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list
# RUN apt-get update

RUN mv /etc/yum.repos.d/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo.backup
RUN curl -o /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-7.repo
RUN yum makecache
RUN yum install -y sendmail mailx
RUN yum install -y python36 python36-devel openssl openssl-devel python36-pip gcc
#ADD ./.pip ~/.pip
ADD ./mail.rc /etc/mail.rc
#RUN pip3.6 install ansible
#RUN LD_LIBRARY_PATH /usr/include/python3.6m
RUN pip3.6 install ansible -i https://pypi.tuna.tsinghua.edu.cn/simple

# RUN apt-get install -y \
#         zip \
#         unzip

# WORKDIR /code/percona-xtrabackup-2.4.12
# RUN tar -xzf percona-xtrabackup-2.4.12-Linux-x86_64.libgcrypt20.tar.gz -C /usr/local 
#ENV PATH $PATH:/usr/local/percona-xtrabackup-2.4.12-Linux-x86_64/bin