FROM php:8.2-apache

# Install system dependencies

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev

# Install PHP extensions

RUN docker-php-ext-install pdo pdo_mysql zip

# Enable Apache rewrite

RUN a2enmod rewrite

# Set working directory

WORKDIR /var/www/html

# Copy project files

COPY . /var/www/html

# Install Composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies

RUN composer install --no-dev --optimize-autoloader

# Fix permissions

RUN chmod -R 777 storage bootstrap/cache

# Set Apache public folder

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
