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
sudo chown -R ubuntu:www-data .
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
php artisan cache:clear 
php artisan config:clear 
php artisan route:clear 
php artisan view:clear 
php artisan event:clear 

# 7. Run database migrations (Fail-safe)
echo "=> Running database migrations..."
php artisan migrate --force || true

# 8. Generate Performance Caches (Fail-safe)
echo "=> Generating performance caches..."
php artisan config:cache 
php artisan route:cache 
php artisan view:cache 
php artisan event:cache 

echo "================================================="
echo "✅ Deployment & Performance Boost Complete!"
echo "================================================="
