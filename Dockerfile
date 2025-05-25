FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first for better layer caching
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy source code
COPY . .

# Set ownership dan permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache \
    && chmod +x artisan

# Tambahkan folder /var/www sebagai safe directory untuk Git
RUN git config --global --add safe.directory /var/www

# Generate autoload files
RUN composer dump-autoload --optimize

# Expose port
EXPOSE 9000

# Switch to www-data user
USER www-data

# Start php-fpm
CMD ["php-fpm"]
