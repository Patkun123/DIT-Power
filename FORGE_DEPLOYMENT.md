# Laravel Forge Deployment Guide for Image Uploads

## Required Configuration for File Uploads to Work

### 1. PHP Configuration (php.ini)
Add these settings in your Forge server's PHP configuration:

```ini
upload_max_filesize = 10M
post_max_size = 12M
max_execution_time = 300
memory_limit = 256M
```

**In Laravel Forge:**
- Go to your server → PHP
- Click on the PHP version you're using
- Add these values to "Additional PHP.ini Configuration"

### 2. Nginx Configuration
Add/update your site's Nginx configuration:

```nginx
client_max_body_size 10M;
```

**In Laravel Forge:**
- Go to your site → Files → Edit Nginx Configuration
- Add `client_max_body_size 10M;` inside the `server` block

### 3. Storage Permissions
Run these commands via Forge's terminal or deployment script:

```bash
cd /home/forge/your-site-name
php artisan storage:link
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R forge:www-data storage
chown -R forge:www-data bootstrap/cache
```

### 4. Environment Variables
Make sure these are set in your `.env`:

```env
FILESYSTEM_DISK=public
LIVEWIRE_TEMPORARY_FILE_UPLOAD_RULES=max:8192
```

### 5. Deployment Script
Add to your Forge deployment script:

```bash
cd /home/forge/your-site-name
git pull origin $FORGE_SITE_BRANCH

$FORGE_COMPOSER install --no-dev --no-interaction --prefer-dist --optimize-autoloader

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock

if [ -f artisan ]; then
    $FORGE_PHP artisan migrate --force
    $FORGE_PHP artisan optimize:clear
    $FORGE_PHP artisan config:cache
    $FORGE_PHP artisan route:cache
    $FORGE_PHP artisan view:cache
    
    # Ensure storage link exists
    $FORGE_PHP artisan storage:link
    
    # Fix permissions
    chmod -R 775 storage bootstrap/cache
    chown -R forge:www-data storage bootstrap/cache
fi
```

### 6. Troubleshooting

If uploads still don't work:

1. **Check Logs:**
   ```bash
   tail -f storage/logs/laravel.log
   tail -f /var/log/nginx/error.log
   ```

2. **Test Upload Permissions:**
   ```bash
   cd storage/app/public
   touch test.txt
   # If this fails, you have permission issues
   ```

3. **Verify Livewire Config:**
   ```bash
   php artisan config:clear
   php artisan livewire:publish --config
   ```

4. **Check Disk Space:**
   ```bash
   df -h
   ```

### 7. Common Issues & Solutions

**Issue:** "The image failed to upload"
- **Solution:** Increase PHP upload limits and Nginx client_max_body_size

**Issue:** "Temporary file upload failed"
- **Solution:** Check `/tmp` directory permissions: `chmod 1777 /tmp`

**Issue:** "Storage link missing"
- **Solution:** Run `php artisan storage:link` and verify the symlink exists

**Issue:** "Permission denied"
- **Solution:** Ensure proper ownership: `chown -R forge:www-data storage`

## Testing Before Deploy

Test locally with production-like settings:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan optimize
```

Upload a test image and check:
- Browser DevTools Network tab for errors
- Laravel log: `tail -f storage/logs/laravel.log`
- Is the file saved in `storage/app/public/posts/`?
- Can you access it via `/storage/posts/filename.jpg`?
