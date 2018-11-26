FROM mysql:5.6
ADD . /code

#RUN sed -i 's/archive.ubuntu.com/mirrors.ustc.edu.cn/g' /etc/apt/sources.list
#RUN sed -i 's/security.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list
#RUN sed -i 's/deb.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list
#RUN sed -i 's/cdn-fastly.deb.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list

RUN sed -i 's/archive.ubuntu.com/mirrors.aliyun.com/g' /etc/apt/sources.list
RUN sed -i 's/security.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list
RUN sed -i 's/deb.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list
RUN sed -i 's/cdn-fastly.deb.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list
RUN apt-get update

RUN apt-get install -y \
        zip \
        unzip

WORKDIR /code/percona-xtrabackup-2.4.12
RUN tar -xzvf percona-xtrabackup-2.4.12-Linux-x86_64.libgcrypt20.tar.gz -C /usr/local 
#WORKDIR /usr/local/percona-xtrabackup-2.4.12-Linux-x86_64 
#RUN echo "PATH=$PATH:/usr/local/percona-xtrabackup-2.4.12-Linux-x86_64/bin" >> /etc/profile
ENV PATH $PATH:/usr/local/percona-xtrabackup-2.4.12-Linux-x86_64/bin
