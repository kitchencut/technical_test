FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev libmcrypt-dev zlib1g-dev \
    mariadb-client curl zip unzip libzip-dev libapache2-mod-fcgid

RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath gd zip

RUN pecl install mcrypt
RUN docker-php-ext-enable mcrypt

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY ./composer.json ./
RUN composer install -o

#RUN php artisan key:generate
#RUN php artisan migrate --seed
EXPOSE 9000

RUN echo "The API Service is Ready!"
