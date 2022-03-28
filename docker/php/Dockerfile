FROM php:8.0-fpm as erpapp-php

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN apt-get update && apt-get install -y

RUN apt-get update && apt-get install -y --no-install-recommends \
      libzip-dev \
    && docker-php-ext-install \
        zip \
        mysqli \
        pdo pdo_mysql

RUN pecl install xdebug-3.1.3 && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && ln -s $(composer config --global home) /root/composer

WORKDIR /var/www/erp

COPY . ./

RUN composer install
