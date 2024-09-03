#Dockerfile for Backend
FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip mysqli pdo pdo_mysql curl

WORKDIR /var/www/html

COPY . /var/www/html
#COPY db_config.php /var/www/html/db_config.php

EXPOSE 80

CMD ["php-fpm"]

