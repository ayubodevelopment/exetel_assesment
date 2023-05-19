FROM php:8.2 as php

RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN docker-php-ext-install pdo pdo_mysql


WORKDIR /var/www
COPY . .

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

ENV PORT=8000
ENTRYPOINT [ "Docker/entrypoint.sh" ]