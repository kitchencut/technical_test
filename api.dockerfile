FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev libmcrypt-dev zlib1g-dev \
    mariadb-client curl zip unzip libzip-dev libapache2-mod-fcgid
RUN apt-get clean && apt-get --purge autoremove -y

RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath gd zip

RUN pecl install mcrypt
RUN docker-php-ext-enable mcrypt

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY ./api/composer.json ./api/composer.lock ./

RUN composer install --dev --no-interaction -o

EXPOSE 9000

RUN echo "The API Service is Ready!"
