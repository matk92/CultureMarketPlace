FROM php:8.2-apache

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN apt-get update -y && apt-get install -y libpng-dev libfreetype6-dev libyaml-dev

RUN  docker-php-ext-configure gd --with-freetype
RUN  docker-php-ext-install gd

RUN pecl install yaml

RUN usermod -u 1000 www-data

RUN a2enmod rewrite