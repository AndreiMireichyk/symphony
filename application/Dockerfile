FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libicu-dev \
        git \
        zip \
        unzip \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql intl sockets opcache\
    && docker-php-ext-enable xdebug \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /application

COPY . .

RUN rm -rf vendor \
    && rm -rf var/cache/* \
    && rm -rf var/log/* \
    && rm -rf var/sessions/* \
    && composer install \
    && composer dump-autoload --optimize \
    && bin/console cache:clear \
    && bin/console cache:warmup \
    && chmod +x /application/bin/* \
    && chown www-data:www-data /application \
    && chown www-data:www-data /application/var -R \
    && chown www-data:www-data /application/public -R


RUN ./vendor/bin/rr get-binary --location /usr/local/bin/

EXPOSE 8080

CMD ["rr", "serve"]