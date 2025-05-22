FROM composer:2 as vendor

WORKDIR /app

COPY composer.* ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_pgsql zip

COPY --from=vendor /app /var/www/html

COPY . .

RUN chmod -R 777 storage bootstrap/cache

CMD php artisan migrate --force && php artisan storage:link && php-fpm 