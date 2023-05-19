#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.exmaple .env
else
    echo "env file exist"
fi

php artisan migrate
php artisan key:generate

php artisan serve --port=$PORT --host=0.0.0.0 --env=./backend/.env
exec docker-php-entrypoint "$@"