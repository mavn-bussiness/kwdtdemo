# cPanel Deployment Guide

## Prerequisites

- cPanel hosting with PHP 8.4+, MySQL, and Git Version Control enabled
- SSH access

## Directory Structure

```
/home/<user>/
├── kwdt/          ← Laravel app (this repo, cloned by cPanel)
└── public_html@   ← Symlink to ~/kwdt/public
```

## First-Time Setup

### 1. Set up repo in cPanel Git Version Control

In cPanel → Git Version Control → Create:
- Repository path: `/home/<user>/kwdt`
- Clone URL: your repo URL

### 2. Symlink `public_html` to the app's public folder (SSH, one-time)

```bash
rm -rf ~/public_html
ln -s ~/kwdt/public ~/public_html
```

### 3. Configure `.env`

```bash
cp ~/kwdt/.env.production ~/kwdt/.env
```

Edit `~/kwdt/.env` and fill in:
- `APP_KEY` — run `php artisan key:generate --show` to get a value
- `APP_URL` — your actual domain
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` — from cPanel MySQL Databases
- `SESSION_DOMAIN` — your domain (e.g. `yourdomain.com`)
- `MAIL_HOST`, `MAIL_USERNAME`, `MAIL_PASSWORD` — your SMTP credentials
- `PAYPAL_CLIENT_ID`, `PAYPAL_CLIENT_SECRET` — live PayPal credentials

### 4. Set permissions

```bash
chmod -R 775 ~/kwdt/storage
chmod -R 775 ~/kwdt/bootstrap/cache
```

### 5. Run initial setup

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

Push to `main` — cPanel Git Version Control runs `.cpanel.yml` automatically.

## Building Assets

cPanel has no Node.js. Build locally before every push:

```bash
npm run build
git add public/build
git commit -m "chore: build assets"
git push
```

## Cron Jobs (Optional)

Task scheduler — add in cPanel Cron Jobs:
```
* * * * * /usr/local/bin/php /home/<user>/kwdt/artisan schedule:run >> /dev/null 2>&1
```

Queue worker:
```
*/5 * * * * /usr/local/bin/php /home/<user>/kwdt/artisan queue:work --stop-when-empty >> /dev/null 2>&1
```
