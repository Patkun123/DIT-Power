# Laravel Forge Deployment Guide

## Image Upload Issues - Common Fixes

If you're experiencing issues with image uploads on Laravel Forge, follow these steps:

### 1. Create Storage Symlink

The storage symlink must be created for images to be accessible:

```bash
php artisan storage:link
```

**In Forge:**
- Go to your site's "Deploy Script" section
- Add this command to your deployment script:
```bash
php artisan storage:link --force
```

### 2. Set Proper Storage Permissions

Ensure the storage directory has proper permissions:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

**In Forge:**
- Go to your site's "Deploy Script" section
- Add these commands:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R forge:www-data storage
chown -R forge:www-data bootstrap/cache
```

### 3. Create Storage Directories

Ensure the required storage directories exist:

```bash
mkdir -p storage/app/public/posts
mkdir -p storage/app/public/profile
mkdir -p storage/app/public/admin-content
chmod -R 775 storage/app/public
```

### 4. Check PHP Upload Limits

Verify your PHP configuration allows file uploads:

**Check current limits:**
```bash
php -i | grep upload_max_filesize
php -i | grep post_max_size
php -i | grep max_execution_time
```

**Recommended settings in `php.ini` or Forge's PHP settings:**
```ini
upload_max_filesize = 10M
post_max_size = 12M
max_execution_time = 300
memory_limit = 256M
```

**In Forge:**
- Go to your server → PHP → Edit PHP Configuration
- Set these values or add them to your custom php.ini

### 5. Check Nginx Configuration

Ensure Nginx allows large file uploads. In Forge, your Nginx config should include:

```nginx
client_max_body_size 10M;
```

### 6. Complete Deployment Script for Forge

Add this to your Forge deployment script:

```bash
cd /home/forge/your-site-name

# Pull latest code
git pull origin main

# Install dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:clear
php artisan config:cache

# Clear and cache routes
php artisan route:clear
php artisan route:cache

# Clear and cache views
php artisan view:clear
php artisan view:cache

# Create storage directories if they don't exist
mkdir -p storage/app/public/posts
mkdir -p storage/app/public/profile
mkdir -p storage/app/public/admin-content

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R forge:www-data storage
chown -R forge:www-data bootstrap/cache

# Create storage symlink
php artisan storage:link --force

# Optimize
php artisan optimize
```

### 7. Troubleshooting Image Scanning

If image scanning is causing issues, you can temporarily disable it by modifying the `CreatePost` component:

**Option 1: Make scanning optional via environment variable**

Add to your `.env`:
```
IMAGE_SCANNING_ENABLED=true
```

Then modify the service to check this flag.

**Option 2: Check Laravel logs**

Check for errors in:
```bash
tail -f storage/logs/laravel.log
```

### 8. Verify Storage Configuration

Ensure your `.env` file has:
```
FILESYSTEM_DISK=public
APP_URL=https://your-domain.com
```

### 9. Test Image Upload

After deployment, test by:
1. Uploading a small image (< 1MB)
2. Check if it appears in `storage/app/public/posts/`
3. Verify the image is accessible via URL

### 10. Common Issues and Solutions

**Issue: "Image file cannot be accessed"**
- Solution: Check file permissions and ensure storage symlink exists

**Issue: "File size exceeds maximum"**
- Solution: Increase `upload_max_filesize` and `post_max_size` in PHP config

**Issue: "Storage symlink already exists"**
- Solution: Remove old symlink: `rm public/storage` then run `php artisan storage:link --force`

**Issue: "Permission denied"**
- Solution: Fix ownership: `chown -R forge:www-data storage`

**Issue: Images upload but don't display**
- Solution: Check storage symlink and verify `APP_URL` in `.env` matches your domain

### 11. Quick Fix Script

Run this on your Forge server via SSH:

```bash
cd /home/forge/your-site-name
php artisan storage:link --force
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R forge:www-data storage
chown -R forge:www-data bootstrap/cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## Need More Help?

Check Laravel logs:
```bash
tail -f storage/logs/laravel.log
```

Check Nginx error logs:
```bash
tail -f /var/log/nginx/error.log
```

