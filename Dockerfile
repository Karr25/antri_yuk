# Menggunakan image PHP resmi dengan Apache
FROM php:8.0-apache

# Set working directory
WORKDIR /var/www/html

# Salin file composer.json dan composer.lock ke dalam image
COPY composer.json composer.lock ./

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Install ekstensi MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install --prefer-dist --no-progress --no-suggest

# Salin semua file aplikasi ke dalam image
COPY src/ .

# Port yang digunakan oleh Apache
EXPOSE 80
