#!/bin/bash

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
until php artisan migrate:status 2>/dev/null; do
    echo "MySQL is unavailable - sleeping"
    sleep 5
done

echo "MySQL is ready!"

# Generate application key if not exists
if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env
fi

# Generate app key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Clear and cache config
echo "Clearing and caching configuration..."
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache

# Run migrations and seed
echo "Running migrations and seeding database..."
php artisan migrate --force
php artisan db:seed --force

# Create symbolic link for storage
echo "Creating storage symbolic link..."
php artisan storage:link

echo "Application setup completed!"

# Execute the main command
exec "$@"