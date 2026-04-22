# cPanel Deployment Guide

## Prerequisites

- cPanel hosting with PHP 8.4+, MySQL, and Git Version Control enabled
- SSH access (recommended) or cPanel Terminal

## Directory Structure

The app lives **above** `public_html` for security:

```
/home/<user>/
├── kwdt/          ← Laravel app (this repo)
└── public_html/   ← Only public/ contents served here
```

## First-Time Setup

### 1. Clone the repo via cPanel Git Version Control

In cPanel → Git Version Control → Create, set:
- Repository path: `/home/<user>/kwdt`
- Clone URL: your repo URL

### 2. Configure the `.env` file

```bash
cp /home/<user>/kwdt/.env.production /home/<user>/kwdt/.env
```

Edit `/home/<user>/kwdt/.env` and fill in:
- `APP_KEY` — generate with `php artisan key:generate --show`
- `APP_URL` — your actual domain
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` — from cPanel MySQL Databases
- `SESSION_DOMAIN` — your domain (e.g. `yourdomain.com`)
- `MAIL_*` — your cPanel email or SMTP credentials
- `PAYPAL_CLIENT_ID`, `PAYPAL_CLIENT_SECRET` — live PayPal credentials

### 3. Point `public_html` to the app's public folder

Option A — Symlink (preferred, requires SSH):
```bash
rm -rf ~/public_html
ln -s ~/kwdt/public ~/public_html
```

Option B — The `.cpanel.yml` deployment task copies `public/` into `public_html` automatically on each deploy.

### 4. Fix `index.php` paths (if using Option B copy approach)

The `.cpanel.yml` patches `index.php` paths automatically. Verify after deploy:
```bash
head -5 ~/public_html/index.php
```

### 5. Set storage permissions

```bash
chmod -R 775 /home/<user>/kwdt/storage
chmod -R 775 /home/<user>/kwdt/bootstrap/cache
```

### 6. Run initial setup

```bash
cd ~/kwdt
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan storage:link --force
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Subsequent Deploys

Push to the connected branch — cPanel Git Version Control will run `.cpanel.yml` automatically.

## Build Assets Locally Before Pushing

Since cPanel has no Node.js, build assets locally before every push:

```bash
npm run build
git add public/build
git commit -m "chore: build assets"
git push
```

## Queue Worker (Optional)

cPanel Cron Jobs → add:
```
* * * * * /usr/local/bin/php /home/<user>/kwdt/artisan schedule:run >> /dev/null 2>&1
```

For queue processing, add a cron (or use Supervisor if available):
```
*/5 * * * * /usr/local/bin/php /home/<user>/kwdt/artisan queue:work --stop-when-empty >> /dev/null 2>&1
```
