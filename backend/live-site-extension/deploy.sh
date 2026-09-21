#!/bin/bash
set -e

PHP=/opt/alt/php84/usr/bin/php

echo "Pulling latest site code..."
git fetch origin main
git reset --hard origin/main
echo "Done. Live site now matches Al-Falah-Website main branch."

echo "Running database migrations..."
$PHP artisan migrate --force

echo "Clearing caches..."
$PHP artisan config:clear
$PHP artisan view:clear
$PHP artisan route:clear
$PHP artisan cache:clear

echo "Deploy complete."
