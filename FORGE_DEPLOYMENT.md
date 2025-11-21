# Laravel Forge Deployment - Storage Configuration

## Issue: Images Not Uploading on Forge

If you're experiencing issues with image uploads on Laravel Forge, it's likely due to storage symlink or permissions issues.

## Quick Fix

### Option 1: Run the Deployment Script (Recommended)

1. SSH into your Forge server
2. Navigate to your project directory
3. Run the deployment script:

```bash
chmod +x deploy.sh
./deploy.sh
```

### Option 2: Manual Fix

1. **SSH into your Forge server** and navigate to your project:
   ```bash
   cd /home/forge/your-site.com
   ```

2. **Create storage directories** (if they don't exist):
   ```bash
   mkdir -p storage/app/public/posts
   mkdir -p storage/app/public/profile
   mkdir -p storage/app/public/admin-content
   mkdir -p storage/app/public/event_images
   ```

3. **Set proper permissions**:
   ```bash
   chmod -R 775 storage
   chmod -R 775 bootstrap/cache
   ```

4. **Remove existing symlink** (if broken):
   ```bash
   rm public/storage
   ```

5. **Create storage symlink**:
   ```bash
   php artisan storage:link
   ```

6. **Verify the symlink**:
   ```bash
   ls -la public/storage
   ```
   Should show: `public/storage -> ../storage/app/public`

## Forge Deployment Script

Add this to your **Laravel Forge Deployment Script** in the Forge dashboard:

```bash
cd /home/forge/your-site.com

# Install dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ensure storage directories exist
mkdir -p storage/app/public/posts
mkdir -p storage/app/public/profile
mkdir -p storage/app/public/admin-content
mkdir -p storage/app/public/event_images

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Create storage symlink (remove if exists first)
rm -f public/storage
php artisan storage:link

# Set ownership (adjust user:group as needed)
chown -R forge:forge storage bootstrap/cache public/storage
```

## Verify Storage Configuration

After deployment, verify:

1. **Symlink exists**:
   ```bash
   ls -la public/storage
   ```

2. **Storage directory is writable**:
   ```bash
   touch storage/app/public/test.txt
   rm storage/app/public/test.txt
   ```

3. **Test image upload** through your application

## Common Issues

### Issue: "Failed to save image. Please check storage permissions."

**Solution**: 
- Ensure `storage/app/public` has write permissions (775)
- Check that the web server user (usually `forge` or `www-data`) owns the storage directory

### Issue: Images upload but don't display

**Solution**:
- Verify the symlink exists: `ls -la public/storage`
- Check that `APP_URL` in `.env` matches your domain
- Clear Laravel cache: `php artisan cache:clear`

### Issue: Symlink creation fails

**Solution**:
- Remove existing symlink: `rm public/storage`
- Create manually: `ln -s ../storage/app/public public/storage`
- Verify ownership: `chown -R forge:forge public/storage`

## Storage Structure

Your storage should look like this:

```
storage/
├── app/
│   └── public/
│       ├── posts/          # Post images
│       ├── profile/        # Profile images
│       ├── admin-content/  # Admin content images
│       └── event_images/   # Event images
└── ...

public/
└── storage -> ../storage/app/public  # Symlink
```

## Testing

After fixing, test image upload:
1. Try uploading an image through the post creation form
2. Check if the image appears in the feed
3. Verify the image URL is accessible: `https://your-site.com/storage/posts/filename.jpg`

## Need Help?

If issues persist:
1. Check Laravel logs: `tail -f storage/logs/laravel.log`
2. Check web server error logs
3. Verify file permissions: `ls -la storage/app/public`
4. Test symlink: `readlink public/storage`

