# Set the base image for subsequent instructions
FROM php:7.4-fpm

# Install PHP and composer dependencies
RUN apt-get update && apt-get install git zip unzip libcurl4-gnutls-dev zlib1g-dev libicu-dev libpng-dev libxml2-dev libzip-dev libbz2-dev openssh-client libonig-dev libjpeg-dev -yqq

# Clear out the local repository of retrieved package files
RUN apt-get clean

RUN docker-php-ext-configure gd --enable-gd --with-jpeg

# Install needed extensions
# Here you can install any other extension that you need during the test and deployment process
RUN docker-php-ext-install mbstring pdo_mysql curl json intl gd xml zip bz2 opcache

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

ARG XDEBUG_INI=/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
ARG XDEBUG_REMOTE_HOST=192.168.1.1
ARG XDEBUG_MODE=debug

RUN echo "xdebug.default_enable = off" >> ${XDEBUG_INI} \
    && echo "xdebug.start_with_request = yes" >> ${XDEBUG_INI} \
    && echo "xdebug.remote_connect_back = off" >> ${XDEBUG_INI} \
    && echo "xdebug.client_port = 9000" >> ${XDEBUG_INI} \
    && echo "xdebug.client_host = ${XDEBUG_REMOTE_HOST}" >> ${XDEBUG_INI} \
    && echo "xdebug.mode = ${XDEBUG_MODE}" >> ${XDEBUG_INI}

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN echo "memory_limit = 1G" >> "$PHP_INI_DIR/php.ini-development"

RUN groupadd -g 1000 host
RUN useradd -u 1000 -ms /bin/bash -g host host
RUN usermod -a -G host www-data
