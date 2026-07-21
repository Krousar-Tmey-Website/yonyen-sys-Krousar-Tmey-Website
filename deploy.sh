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

# 3. Set correct permissions early (prevents 500 errors if script crashes later)
echo "=> Setting correct permissions..."
sudo chown -R ubuntu:ubuntu .
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# 4. Install/Update PHP Dependencies (Optimized for Production)
echo "=> Installing Composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# 5. Install/Update Node Dependencies & Build Assets
echo "=> Building frontend assets..."
npm install
npm run build

# 6. Clear all old caches (Fail-safe)
echo "=> Clearing old caches..."
php artisan cache:clear || true
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan event:clear || true

# 7. Run database migrations (Fail-safe)
echo "=> Running database migrations..."
php artisan migrate --force || true

# 8. Generate Performance Caches (Fail-safe)
echo "=> Generating performance caches..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true
php artisan event:cache || true

echo "================================================="
echo "✅ Deployment & Performance Boost Complete!"
echo "================================================="
