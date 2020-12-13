#!/bin/bash

# Create config file
cp .env.example .env

# Give right access
chmod 777 -R storage
chmod 777 -R bootstrap/cache

# Start the project
docker-compose up --build -d

# Install project dependencies
docker-compose exec app composer install

# Generate the project key
docker-compose exec app php artisan key:generate

# Generate the JWT key
docker-compose exec app php artisan jwt:secret

# Run database migrations
docker-compose exec app php artisan migrate

# Create a symbolic link for uploaded files
docker-compose exec app php artisan storage:link
