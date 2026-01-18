FROM serversideup/php:8.5-fpm-nginx-alpine

ENV PHP_OPCACHE_ENABLE=1 \
    AUTORUN_ENABLED=true

USER root
RUN apk add --no-cache nodejs npm

WORKDIR /var/www/html

# Copier TOUS les fichiers d'abord
COPY --chown=www-data:www-data . .

# Installer les dépendances Composer
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction

# Installer les dépendances NPM
RUN npm install --frozen-lockfile

# Build des assets
RUN npm run build

# Créer le lien symbolique storage
RUN php artisan storage:link

# Assurer les bonnes permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data
