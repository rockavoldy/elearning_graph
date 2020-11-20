FROM php:7.0.33-apache
WORKDIR /var/www/html

RUN docker-php-ext-install mysqli \
    && chmod -R 775 /var/www/html \
    && chown -R www-data:www-data /var/www/html