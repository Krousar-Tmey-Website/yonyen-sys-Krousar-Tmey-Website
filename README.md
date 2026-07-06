# Krousar Thmey — Website

Official website for **Krousar Thmey** (ក្រួសថ្មី), Cambodia's first organisation dedicated to helping disadvantaged children — founded in 1991 in the Site II refugee camp in Thailand.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2 + Laravel 11 |
| Templating | Blade |
| CSS | Tailwind CSS v4 (via `@tailwindcss/vite`) |
| JavaScript | Alpine.js v3 + `@alpinejs/focus` |
| Build tool | Vite |
| Database | MySQL |
| Email | Laravel Mail (SMTP) |

---

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+ and npm
- MySQL 8+
- A Gmail account (or other SMTP) for email sending

---

## Local Installation

### 1. Clone and install dependencies

```bash
cd krousar-thmey
composer install
npm install
```

### 2. Copy environment file

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configure the database

Open `.env` and set your MySQL credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=krousar_thmey
DB_USERNAME=root
DB_PASSWORD=your_password
```

Create the database in MySQL first:

```sql
CREATE DATABASE krousar_thmey CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. Run migrations and seed

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

This creates all tables and populates:
- Admin user account
- 3 hero slideshow slides
- 5 programs
- 14 home page settings
- 70+ partner organisations
- 8 awards

### 5. Build frontend assets

```bash
# Development (with hot reload)
npm run dev

# Production build
npm run build
```

### 6. Start the server

```bash
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000)

---

## Admin Panel

### Login

Go to [http://localhost:8000/admin/login](http://localhost:8000/admin/login)

| Email | Password |
|---|---|
| `admin@krousar-thmey.org` | `Admin@KT2024` |

> **Important:** Change the password after first login.

### What you can manage

| Section | URL | Description |
|---|---|---|
| Dashboard | `/admin` | Overview of content counts and recent articles |
| **Slideshow** | `/admin/slides` | Hero carousel slides — image, title, subtitle, buttons |
| **News Articles** | `/admin/news` | Add, edit, delete news articles with image upload |
| **Programs** | `/admin/programs` | Edit program titles, descriptions, images |
| **Home Settings** | `/admin/home` | Edit key statistics and hero slide text |
| **Partners** | `/admin/partners` | Add/remove partner organisations by category |
| **Awards** | `/admin/awards` | Add/remove awards with icon, organization, description |

---

## Email Configuration

The donation contact form sends two emails: one to the KT team and one confirmation to the donor.

Configure in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_SCHEME=tls
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=your-app-password        # Gmail App Password (not your login password)
MAIL_FROM_ADDRESS="no-reply@krousar-thmey.org"
MAIL_FROM_NAME="Krousar Thmey"
MAIL_DONATION_RECIPIENT=info@krousar-thmey.org
```

> For Gmail: enable 2-Step Verification, then generate an **App Password** at myaccount.google.com/apppasswords. Use that 16-character code as `MAIL_PASSWORD`.

---

## Image Assets

Place images in `public/images/`:

| File | Used on |
|---|---|
| `logo.png` | Navbar and footer |
| `special-ed.jpg` | Programs page, About page |
| `cultural.jpg` | Programs page, About page |
| `hygiene.jpg` | Programs page |
| `children.jpg` | Home page, About page |
| `program.jpg` | Programs page, About page |
| `cover.jpg` | News article fallback image |
| `qr-aba.png` | Donate page — ABA Pay QR code |
| `qr-acleda.png` | Donate page — ACLEDA QR code |

Images uploaded through the admin panel (slides, news articles, programs) are stored in `storage/app/public/` and served via the `public/storage` symlink created by `php artisan storage:link`.

---

## Project Structure

```
krousar-thmey/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── SlideController.php
│   │   │   │   ├── NewsController.php
│   │   │   │   ├── ProgramController.php
│   │   │   │   ├── HomeSettingController.php
│   │   │   │   ├── PartnerController.php
│   │   │   │   └── AwardController.php
│   │   │   └── DonationController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Slide.php
│       ├── News.php
│       ├── Program.php
│       ├── HomeSetting.php
│       ├── Partner.php
│       └── Award.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── AdminSeeder.php
├── resources/
│   ├── css/app.css                  # Tailwind v4 theme + component classes
│   ├── js/app.js                    # Alpine.js initialisation
│   └── views/
│       ├── layouts/app.blade.php    # Public site layout (navbar + footer)
│       ├── admin/
│       │   ├── layouts/app.blade.php
│       │   ├── login.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── slides/
│       │   ├── news/
│       │   ├── programs/
│       │   ├── home/
│       │   ├── partners/
│       │   └── awards/
│       ├── home.blade.php
│       ├── about.blade.php
│       ├── programs.blade.php
│       ├── news.blade.php
│       ├── involved.blade.php
│       ├── donate.blade.php
│       ├── resources.blade.php
│       ├── contact.blade.php
│       └── emails/
│           └── donation-request.blade.php
├── public/
│   └── images/                      # Static images (logo, programs, QR codes)
└── routes/web.php
```

---

## Brand Colours

| Name | Hex | Usage |
|---|---|---|
| KT Blue | `#2d6fa3` | Primary — headings, links, buttons |
| KT Blue Dark | `#1d4e7a` | Hover states, footer background |
| KT Olive | `#8da83a` | Accents, secondary buttons, highlights |

Tailwind utility classes defined in `resources/css/app.css`:

| Class | Description |
|---|---|
| `btn-primary` | Olive green filled button |
| `btn-blue` | KT blue filled button |
| `btn-outline` | White outlined button (for dark backgrounds) |
| `nav-link` | Navbar link with animated underline |
| `card` | White rounded card with shadow |

---

## Public Pages

| URL | Page |
|---|---|
| `/` | Home — hero slideshow, stats, programs, latest news |
| `/who-we-are` | About — presentation, history, awards, partners, transparency |
| `/our-programs` | Programs — child welfare, special education, cultural arts |
| `/get-involved` | Get Involved — donate, partner, volunteer, jobs |
| `/news` | News — filterable article grid from database |
| `/resources` | Resources — annual reports, media kit |
| `/contact` | Contact — 4 office locations, contact form |
| `/donate` | Donate — local QR codes (ABA/ACLEDA) + international form |

---

## How the Slideshow Works

The hero carousel on the home page reads all **active** slides from the database, ordered by `sort_order`.

- **Add a slide** → goes to `/admin/slides/create`
- **Set sort order** → lower numbers appear first (1 = first slide)
- **Toggle active/hidden** → hide a slide without deleting it
- The carousel auto-advances every 5.5 seconds
- Dot indicators and prev/next arrows only appear when there are 2 or more active slides

---

## How News Works

News articles are managed at `/admin/news`.

- Articles saved as **Draft** are not visible on the public site
- Checking **Published** makes them appear on `/news` and the home page latest news section
- The home page shows the 3 most recently published articles
- Categories you create in the admin automatically appear as filter tabs on the news page

---

## Deployment Notes

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Set `APP_URL` to your live domain
3. Run `npm run build` to compile assets
4. Run `php artisan config:cache` and `php artisan route:cache`
5. Ensure `storage/` and `bootstrap/cache/` are writable by the web server
6. Run `php artisan storage:link` on the production server
7. Configure a real SMTP provider for emails (see Email Configuration above)

---

## Support

For questions about the website, contact the Krousar Thmey team:

- **Email:** info@krousar-thmey.org
- **Website:** https://www.krousar-thmey.org/

---

*Built with love for the children of Cambodia.*
