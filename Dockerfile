# Step 1: Base image with PHP and extensions
FROM php:8.2-fpm

# Step 2: Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libzip-dev zip nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql zip

# Step 3: Set working directory
WORKDIR /var/www/html

# Step 4: Copy project files
COPY . .

# Step 5: Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Step 6: Laravel storage & permissions
RUN php artisan storage:link && \
    chmod -R 777 storage bootstrap/cache

# Step 7: Run migrations and start PHP
CMD php artisan migrate --force && php-fpm
