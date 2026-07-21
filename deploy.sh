#!/bin/bash

# Exit immediately if a command exits with a non-zero status
set -e

# ALWAYS bring the application back online when the script exits (success or fail)
trap 'echo "=> Bringing application online..."; php artisan up || true' EXIT

echo "================================================="
echo "🚀 Starting Krousar Thmey Performance Deployment"
echo "================================================="

# 1. Take application offline (shows 503 maintenance page)
echo "=> Taking application offline..."
php artisan down || true

# 2. Pull latest changes
echo "=> Pulling latest code..."
git pull origin develop-fix

# 3. Install/Update PHP Dependencies (Optimized for Production)
echo "=> Installing Composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# 4. Install/Update Node Dependencies & Build Assets
echo "=> Building frontend assets..."
npm install
npm run build

# 5. Clear all old caches
echo "=> Clearing old caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

# 6. Run database migrations
echo "=> Running database migrations..."
php artisan migrate --force

# 7. Generate Performance Caches
echo "=> Generating performance caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 8. Set correct permissions
echo "=> Setting correct permissions..."
sudo chown -R ubuntu:ubuntu .
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

echo "================================================="
echo "✅ Deployment & Performance Boost Complete!"
echo "================================================="
