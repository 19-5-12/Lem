# Use official PHP image with required extensions
FROM php:8.2-fpm

# Install system dependencies, Node.js, npm, and Nginx
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip curl libpq-dev libzip-dev zip nodejs npm nginx \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_pgsql zip

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install Composer (assuming composer.json is in the root)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www

# Copy Nginx configuration
COPY nginx/default.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Create a simple script to start Nginx and PHP-FPM
RUN echo '#!/bin/bash' > /usr/local/bin/start.sh \
    && echo 'service nginx start' >> /usr/local/bin/start.sh \
    && echo 'php-fpm' >> /usr/local/bin/start.sh \
    && chmod +x /usr/local/bin/start.sh

# Expose port 80 for Nginx
EXPOSE 80

# Run the startup script
CMD ["start.sh"]
