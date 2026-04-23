FROM dunglas/frankenphp:1.4-php8.4-alpine

RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    bcmath \
    gd \
    zip \
    intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts

ENV SERVER_NAME=":80"

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
