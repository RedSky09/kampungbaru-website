FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    default-mysql-client \
    zip \
    curl \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install \
        intl \
        zip \
        pdo_mysql \
        mysqli \
        pdo_pgsql \
        pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
