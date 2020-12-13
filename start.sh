#!/bin/bash

# Create config file
cp .env.example .env

# Start the project
docker-compose up --build -d

# Install project dependencies
docker-compose exec app composer install

# Generate the project key
docker-compose exec app php artisan key:generate

# Give right access
chmod 777 -R storage
chmod 777 -R bootstrap/cache
