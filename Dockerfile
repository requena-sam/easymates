FROM serversideup/php:8.5-fpm-nginx-alpine

ENV PHP_OPCACHE_ENABLE=1 \
    AUTORUN_ENABLED=true

USER root
RUN apk add --no-cache nodejs npm

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .

RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction

RUN npm install --frozen-lockfile

RUN npm run build

RUN php artisan storage:link

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data
