FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Création du fichier SQLite
RUN mkdir -p database && touch database/database.sqlite

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/database

EXPOSE 8000

# Commande de démarrage avec migration sécurisée (ne bloque pas en cas d'erreur)
CMD php artisan migrate --force ; php artisan serve --host=0.0.0.0 --port=8000