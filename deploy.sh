#!/bin/bash

# Laravel Forge Deployment Script
# This script ensures storage is properly configured for image uploads

echo "🔧 Setting up storage for Laravel Forge..."

# Navigate to project directory
cd "$(dirname "$0")"

# Ensure storage directories exist
echo "📁 Creating storage directories..."
mkdir -p storage/app/public/posts
mkdir -p storage/app/public/profile
mkdir -p storage/app/public/admin-content
mkdir -p storage/app/public/event_images

# Set proper permissions
echo "🔐 Setting storage permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Remove existing symlink if it exists (broken or incorrect)
if [ -L "public/storage" ]; then
    echo "🔗 Removing existing storage symlink..."
    rm public/storage
fi

# Create storage symlink
echo "🔗 Creating storage symlink..."
php artisan storage:link

# Verify symlink was created
if [ -L "public/storage" ]; then
    echo "✅ Storage symlink created successfully!"
else
    echo "❌ Failed to create storage symlink. Trying manual creation..."
    ln -s ../storage/app/public public/storage
    if [ -L "public/storage" ]; then
        echo "✅ Storage symlink created manually!"
    else
        echo "❌ Failed to create storage symlink. Please check permissions."
        exit 1
    fi
fi

# Set ownership (adjust user:group as needed for your Forge setup)
# Uncomment and modify the following line if needed:
# chown -R forge:forge storage bootstrap/cache public/storage

echo "✅ Storage setup complete!"
echo ""
echo "📋 Storage configuration:"
echo "   - Storage path: storage/app/public"
echo "   - Public symlink: public/storage"
echo "   - Posts directory: storage/app/public/posts"
echo ""

