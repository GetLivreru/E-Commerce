FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Configure PHP
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html

# Ensure storage directory has proper permissions
RUN mkdir -p /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/storage/framework/cache \
    /var/www/html/bootstrap/cache

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install composer dependencies if composer.json exists
RUN if [ -f "composer.json" ]; then \
    composer install --no-interaction --optimize-autoloader --no-dev; \
fi

# Expose port 9000 for PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]

