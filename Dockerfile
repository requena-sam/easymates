FROM serversideup/php:8.5-fpm-nginx-alpine

ENV PHP_OPCACHE_ENABLE=1 \
    AUTORUN_ENABLED=true

USER root
RUN apk add --no-cache nodejs npm

WORKDIR /var/www/html

COPY composer.json composer.lock ./

COPY package.json package-lock.json ./
RUN npm install --frozen-lockfile

RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction

COPY --chown=www-data:www-data . .

COPY . .

RUN php artisan storage:link

RUN npm run build

USER www-data

