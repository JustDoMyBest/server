FROM php:5.6-fpm
ADD . /code

ENV ORACLE_HOME /usr/local/instantclient
ENV ORACLE_BASE /usr/local/instantclient

#RUN sed -i 's/archive.ubuntu.com/mirrors.ustc.edu.cn/g' /etc/apt/sources.list
#RUN sed -i 's/security.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list
#RUN sed -i 's/deb.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list
#RUN sed -i 's/cdn-fastly.deb.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list

RUN sed -i 's/archive.ubuntu.com/mirrors.aliyun.com/g' /etc/apt/sources.list
RUN sed -i 's/security.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list
RUN sed -i 's/deb.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list
RUN sed -i 's/cdn-fastly.deb.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list
RUN apt-get update

WORKDIR /code/Mssql
RUN tar -xzvf freetds-1.00.tar.gz
WORKDIR ./freetds-1.00
RUN ./configure --prefix=/usr/local/freetds --enable-msdblib && make && make install 

WORKDIR /code/oracle18_3
RUN apt-get install -y \
        zip \
        unzip
RUN for file in $(ls);do unzip $file;done
RUN mv instantclient_18_3 /usr/local/instantclient
RUN echo "/usr/local/instantclient" >> /etc/ld.so.conf \
        && ldconfig

RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        *libmemcached* \
        *libaio* \
        && docker-php-ext-install -j$(nproc) iconv mysql mysqli pdo_mysql \
        && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
        && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-configure mssql --with-mssql=/usr/local/freetds \
        && docker-php-ext-install -j$(nproc) mssql \
        && docker-php-ext-configure oci8 --with-oci8=instantclient,/usr/local/instantclient \
        && docker-php-ext-install -j$(nproc) oci8 \
        && pecl install redis memcache \
        && docker-php-ext-enable redis memcache
#oci8-2.0.12 

WORKDIR /usr/local/etc/php
RUN cp -p php.ini-production php.ini

RUN usermod -u 1000 www-data
RUN usermod -u 33 www-data

WORKDIR /usr/sbin
#RUN pecl install redis
CMD ["php-fpm"]
