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

# Copy source code + set ownership
COPY --chown=www-data:www-data . /var/www

# Set permission khusus storage & cache Laravel
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Tambahkan folder /var/www sebagai safe directory untuk Git
RUN git config --global --add safe.directory /var/www

# Jalankan composer install sebagai user root (agar vendor bisa dibuat), lalu ubah jadi www-data
RUN composer install --no-dev --optimize-autoloader && \
    chown -R www-data:www-data /var/www

# Ganti ke user www-data
USER www-data

# Generate key di sini kalau mau
RUN php artisan key:generate || true

# Expose port & run php-fpm
EXPOSE 9000
CMD ["php-fpm"]
