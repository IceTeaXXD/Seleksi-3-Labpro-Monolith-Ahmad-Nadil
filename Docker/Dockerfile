# Use the official PHP image as the base image
FROM php:8.1.0-fpm

# Set the working directory inside the container
WORKDIR /var/www/html

# Install system dependencies and PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Install Composer (PHP package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Laravel files to the working directory inside the container
COPY . .

# Install Laravel dependencies using Composer
RUN composer install

# Set the permissions for Laravel storage and bootstrap/cache directories
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose the port on which PHP-FPM listens
EXPOSE 9000

# Start PHP-FPM (PHP FastCGI Process Manager)
CMD ["php-fpm"]
