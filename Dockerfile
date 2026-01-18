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

RUN mkdir -p storage  \
    && chown -R www-data:www-data storage \
    && chmod -R 775 storage

RUN npm run build

USER www-data

