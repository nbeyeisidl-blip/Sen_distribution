FROM php:8.2-cli

# Installer les dépendances système et extensions PHP requises
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Créer le fichier SQLite et exécuter les migrations
RUN touch database/database.sqlite

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Configurer les permissions Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/database

EXPOSE 8000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000