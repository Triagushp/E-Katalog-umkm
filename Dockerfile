# Stage 1: Build dependencies
FROM composer:2 AS composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --optimize-autoloader

# Stage 2: Final image
FROM php:8.1-fpm-alpine

# Install minimal required packages (Alpine is faster)
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl

# Set working directory
WORKDIR /var/www

# Copy dependencies from composer stage
COPY --from=composer /app/vendor ./vendor

# Copy application
COPY . .

# Copy composer binary
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache \
    && chmod +x artisan

# Generate autoloader
RUN composer dump-autoload --optimize

# Create directories
RUN mkdir -p storage/logs storage/framework/{cache,sessions,views} \
    && chown -R www-data:www-data storage

# Configure git
RUN git config --global --add safe.directory /var/www

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
