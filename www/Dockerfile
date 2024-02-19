FROM php:8.2-apache

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN apt-get update -y && apt-get install -y libpng-dev libfreetype6-dev libyaml-dev

# Install unzip and libzip-dev
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libzip-dev
    
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install zip extension
RUN docker-php-ext-install zip

RUN  docker-php-ext-configure gd --with-freetype
RUN  docker-php-ext-install gd

RUN pecl install yaml

RUN usermod -u 1000 www-data

RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html/

COPY ./ ./

# Install dependencies with Composer
ENV COMPOSER_ALLOW_SUPERUSER 1
CMD composer install --no-interaction --no-progress --no-suggest --optimize-autoloader --no-scripts && docker-php-entrypoint apache2-foreground