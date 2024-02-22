#!/bin/bash

# Change directory to your Laravel application root
cd /var/www/html/api

# Pull latest changes from the dev branch
git pull origin dev

# Install composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Run database migrations and seeders
php artisan migrate --force

# Restart PHP-FPM service
sudo systemctl restart php8.2-fpm
