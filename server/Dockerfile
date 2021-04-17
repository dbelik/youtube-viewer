FROM php:7.4-fpm

WORKDIR /var/www/youtube-viewer

RUN groupadd --gid=1000 dev && useradd -u 1000 -N --gid=1000 -s /bin/bash -m dev

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git zip 

COPY composer.json composer.json
COPY composer.lock composer.lock