FROM php:7.2-apache

# Install packages under Debian
RUN apt-get update && \
    apt-get -y install git

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Copy xdebug.ini to /usr/local/etc/php/conf.d/
COPY files-to-copy/ /