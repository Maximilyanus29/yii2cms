FROM php:7.3-fpm

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apt update && chmod +x /usr/local/bin/install-php-extensions && \
     apt install zip -y \
    && install-php-extensions gd \
    && install-php-extensions pgsql
