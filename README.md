# Krousar Thmey — Website

Official website for **Krousar Thmey** (ក្រួសារថ្មី), Cambodia's first organisation dedicated to helping disadvantaged children — founded in 1991 in the Site II refugee camp in Thailand.

The site is bilingual (English / French) and ships with a full admin panel for managing pages, news, programs, donations, and more.

---

## Table of Contents

1. [Tech Stack](#tech-stack)
2. [Requirements](#requirements)
3. [Getting Started (New Developers)](#getting-started-new-developers)
4. [Environment Variables](#environment-variables)
5. [Useful Commands](#useful-commands)
6. [Project Structure](#project-structure)
7. [Admin Panel](#admin-panel)
8. [Bilingual (EN/FR) Content](#bilingual-enfr-content)
9. [Troubleshooting](#troubleshooting)
10. [Git Workflow](#git-workflow)
11. [Deployment — Step by Step](#deployment--step-by-step)
12. [Support](#support)

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2+ · Laravel 12 |
| Templating | Blade + Alpine.js v3 |
| CSS | Tailwind CSS v4 (via `@tailwindcss/vite`) |
| Rich text editor | CKEditor 5 |
| Build tool | Vite 7 |
| Database | MySQL 8+ |
| Email | Laravel Mail (SMTP) |

---

## Requirements

Install these before you start:

- **PHP 8.2+** with the usual extensions (`mbstring`, `pdo_mysql`, `openssl`, `fileinfo`, `gd` or `imagick`)
- **Composer** ([getcomposer.org](https://getcomposer.org))
- **Node.js 18+** and npm
- **MySQL 8+** — either a standalone install, or a bundled stack like **XAMPP / Laragon / Herd** (any of these work fine, just make sure the MySQL service is running before you migrate)
- Git

---

## Getting Started (New Developers)

### 1. Clone the repository

```bash
git clone https://github.com/Krousar-Tmey-Website/yonyen-sys-Krousar-Tmey-Website.git
cd yonyen-sys-Krousar-Tmey-Website
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Set up your environment file

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` and check/update at least these:

```env
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=krousar_thmey
DB_USERNAME=root
DB_PASSWORD=
```

> ⚠️ `.env.example` currently ships with a **real Gmail account and app password** for `MAIL_*`. That's a leaked credential sitting in version control — see the [Troubleshooting](#troubleshooting) note below. Don't rely on it; ask a maintainer for your own mail credentials or point `MAIL_MAILER` at `log` while developing locally so mail just writes to `storage/logs/laravel.log` instead of actually sending.

### 4. Create the database

If it doesn't already exist, create it in MySQL (phpMyAdmin, `mysql` CLI, TablePlus, etc.):

```sql
CREATE DATABASE krousar_thmey CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Run migrations and seed sample data

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

This creates all tables and seeds:
- An admin user account (see [Admin Panel](#admin-panel) for credentials)
- Home page settings, offices, annual reports
- Sample resource pages
- (Local environment only) sample news articles and map project data

### 6. Build frontend assets

```bash
# Development — watches files and hot-reloads
npm run dev

# One-off production build
npm run build
```

Keep `npm run dev` running in its own terminal tab while you work — Blade views expect Vite's dev server for hot module reloading.

### 7. Start the app server

```bash
php artisan serve
```

Visit **http://localhost:8000**. Log into the admin panel at **http://localhost:8000/admin/login**.

> If you're using XAMPP/Laragon instead of `php artisan serve`, just point your virtual host's document root at the `public/` folder and make sure `APP_URL` in `.env` matches the URL you use to access it.

---

## Environment Variables

The important groups in `.env`:

| Group | Keys | Notes |
|---|---|---|
| App | `APP_ENV`, `APP_DEBUG`, `APP_URL`, `APP_LOCALE`, `APP_FALLBACK_LOCALE` | `APP_DEBUG` must be `false` in production |
| Database | `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | MySQL only — the app isn't tested against other drivers |
| Session/Cache/Queue | `SESSION_DRIVER`, `CACHE_STORE`, `QUEUE_CONNECTION` | All default to the `database` driver, so the `sessions`, `cache`, and `jobs` tables must exist (created by the default Laravel migrations) |
| Mail | `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS` | Used for the contact form and donation notification emails. For Gmail SMTP you need a 16-character **App Password**, not the account login password — enable 2-Step Verification, then generate one at `myaccount.google.com/apppasswords` |
| Filesystem | `FILESYSTEM_DISK` | Should stay `public` — admin uploads (images, PDFs) are stored under `storage/app/public` and served via the `public/storage` symlink |

---

## Useful Commands

```bash
# Re-run all migrations from scratch (drops all tables first — local dev only!)
php artisan migrate:fresh --seed

# Check what migrations have/haven't run
php artisan migrate:status

# Interactive REPL to poke at models/data
php artisan tinker

# List every registered route
php artisan route:list

# Clear cached views/config/routes after pulling changes
php artisan optimize:clear

# Regenerate IDE helper files (autocompletion for models/facades)
php artisan ide-helper:generate
php artisan ide-helper:models

# Regenerate the public/storage symlink if uploads 404
php artisan storage:link

# Rebuild thumbnails for annual report PDFs
php artisan reports:generate-thumbnails
```

---

## Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/              # One controller per admin section (News, Programs, Books, Offices, …)
│   │   └── *.php               # Public-facing controllers
│   ├── Http/Middleware/
│   │   ├── AdminMiddleware.php # Gates /admin/* routes behind auth
│   │   └── SetLocale.php       # Reads the session locale and calls App::setLocale()
│   └── Models/                 # One Eloquent model per table
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── css/                    # app.css (public site) + admin-*.css (admin panel)
│   ├── js/                     # app.js (Alpine init, locale switching) + admin-*.js
│   └── views/
│       ├── layouts/app.blade.php        # Public site shell (navbar/footer)
│       ├── admin/layouts/app.blade.php  # Admin shell (sidebar nav)
│       ├── admin/                       # Admin CRUD views, grouped by section
│       └── *.blade.php                  # Public pages (home, about, news, contact, …)
├── routes/web.php              # All routes — public + admin, no route files split by module
└── public/                     # Web root — images, compiled assets, storage symlink
```

The admin sidebar (`resources/views/admin/layouts/app.blade.php`) is the single source of truth for what's manageable — it's organised into these top-level groups: **Dashboard, Campaigns, Homepage, Who We Are, Our Programs, News & Resources, Get Involved, Donations, Communication, Website Management**. Open that file to see every admin route in one place.

---

## Admin Panel

**URL:** `/admin/login`

| Email | Password |
|---|---|
| `admin@krousar-thmey.org` | `Admin@KT2024` |

> **Change this password after your first login on any environment that isn't purely local**, and never reuse it in production.

---

## Bilingual (EN/FR) Content

The site defaults to English and switches to French when a visitor hits `GET /lang/fr` (there's a language toggle in the navbar that does this). The choice is stored in the session by `App\Http\Middleware\SetLocale`, which is registered globally on the `web` middleware group in `bootstrap/app.php`.

Two patterns exist for bilingual fields, depending on the page:

- **Database-backed pages** (News, Programs, Presentation, Contact, etc.) — most translatable fields have a matching `_fr` column (e.g. `title` / `title_fr`). Admin forms show one EN/FR toggle per section; leaving a French field blank falls back to the English value on the public site.
- **Static UI strings** — wrapped in `{{ __('...') }}` and translated via `lang/fr.json`.

If you add a new bilingual field, follow the existing `_fr` column convention and make sure both the admin form and the public Blade view apply the same "fall back to English if French is empty" logic — grep the codebase for `getLocale() === 'fr'` to see the established pattern.

---

## Troubleshooting

**`SQLSTATE[42S02]: Base table or view not found: 1932 ... doesn't exist in engine` when running `php artisan migrate`**
This is MySQL/InnoDB data-dictionary corruption, usually from XAMPP's MySQL service being killed uncleanly. Stop MySQL, back up `mysql/data` if you care about other databases on that instance, and either restore from a backup or reinitialize the MySQL data directory, then re-run `php artisan migrate`.

**Uploaded images 404 on the public site**
Run `php artisan storage:link`. On Windows this needs to be run with sufficient privileges to create a symlink — run your terminal as Administrator if it silently fails.

**Blade changes not showing up**
Run `php artisan view:clear`. If you're not running `npm run dev`, also run `npm run build` — compiled CSS/JS won't reflect your changes until then.

**Route not found errors after pulling changes**
Run `php artisan route:clear` (or `optimize:clear`) — stale cached routes are a common cause after merging in new routes.

**The leaked mail credential in `.env.example`**
`.env.example` currently contains a real Gmail address and app password under `MAIL_USERNAME`/`MAIL_PASSWORD`. It's tracked in git history. If this repo is or ever becomes public, that password should be revoked/rotated in the Google account and replaced with a placeholder in `.env.example`.

---

## Git Workflow

This repo uses feature branches merged into `master` via pull request — you'll see the convention in existing branch names:

- `feature/<short-description>` — new functionality
- `fix/<short-description>` — bug fixes
- `develop*` — longer-running integration branches

Before opening a PR:

```bash
git pull origin master        # rebase or merge in the latest master first
composer install && npm install   # in case dependencies changed
php artisan migrate               # in case new migrations landed
```

There's no CI pipeline configured yet, so please manually check `php artisan route:list` boots without error and click through the pages you touched before merging.

---

## Deployment — Step by Step

These steps assume a Linux server with PHP 8.2+, MySQL, and a web server (Nginx or Apache) already installed, and that you're deploying by pulling from `master`. Adjust paths/commands for your actual host (shared hosting, VPS, Forge, etc.).

### 1. Get the code onto the server

```bash
# First deploy
git clone https://github.com/Krousar-Tmey-Website/yonyen-sys-Krousar-Tmey-Website.git
cd yonyen-sys-Krousar-Tmey-Website

# Subsequent deploys
git pull origin master
```

### 2. Install dependencies (production mode)

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

`--no-dev` skips dev-only packages (Pint, Pail, test tooling). `npm run build` compiles and hashes assets into `public/build/` — the `.env` file doesn't need any Vite-specific config since `laravel-vite-plugin` reads the manifest automatically.

### 3. Configure `.env` for production

Copy `.env.example` to `.env` on first deploy (`cp .env.example .env`), then set:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://www.krousar-thmey.org      # your real domain, https

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=<production_db_name>
DB_USERNAME=<production_db_user>
DB_PASSWORD=<production_db_password>

SESSION_DOMAIN=.krousar-thmey.org          # so the locale/session cookie works across subdomains, if any
SESSION_SECURE_COOKIE=true                 # served over HTTPS

MAIL_MAILER=smtp
MAIL_HOST=<real SMTP host>
MAIL_USERNAME=<real SMTP user>
MAIL_PASSWORD=<real SMTP app password>
```

Then generate a fresh app key **if this is a brand-new environment** (never regenerate it on an environment that already has encrypted data/sessions — it will invalidate them):

```bash
php artisan key:generate
```

### 4. Run database migrations

```bash
php artisan migrate --force
```

`--force` is required because Laravel blocks destructive commands in production unless explicitly confirmed. Review pending migrations first with `php artisan migrate:status` if you want to be cautious — some migrations in this codebase drop legacy tables (`categories`, `article_categories`), which is expected and safe on an up-to-date database.

### 5. Link storage and set permissions

```bash
php artisan storage:link

# Web server user (e.g. www-data) needs write access to these:
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 6. Cache config, routes, and views for performance

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

> If you change `.env` after this, you **must** re-run `php artisan config:cache` (or `config:clear`) — cached config takes priority over `.env` once cached.

### 7. Point the web server document root at `public/`

Nginx example:

```nginx
root /var/www/krousar-thmey/public;
index index.php;

location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/run/php/php8.2-fpm.sock;
    fastcgi_index index.php;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
}
```

Never point the document root at the repo root — everything outside `public/` (including `.env`) must stay outside the webserver's reach.

### 8. Restart PHP-FPM (and reload the web server)

```bash
sudo systemctl restart php8.2-fpm
sudo systemctl reload nginx
```

### 9. Post-deploy checklist

- [ ] Visit the homepage and confirm it loads over HTTPS with no mixed-content warnings
- [ ] Log into `/admin/login` and confirm the dashboard loads
- [ ] Switch to French via the navbar toggle and confirm content changes
- [ ] Submit the contact form and confirm the email arrives
- [ ] Check `storage/logs/laravel.log` for unexpected errors right after deploy

### Redeploying later (subsequent releases)

```bash
git pull origin master
composer install --no-dev --optimize-autoloader
npm ci && npm run build
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
sudo systemctl reload php8.2-fpm
```

For true zero-downtime deploys, deploy into a fresh release directory and symlink it into place (Laravel Forge / Deployer / a simple `current` symlink pattern) rather than pulling directly into the live directory — that way a failed deploy never leaves the site half-updated.

---

## Support

For questions about the website, contact the Krousar Thmey team:

- **Email:** info@krousar-thmey.org
- **Website:** https://www.krousar-thmey.org/

---

*Built with love for the children of Cambodia.*
