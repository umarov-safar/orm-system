FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql  \
    && apt-get install zip unzip

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy your application files
COPY . .

# Expose ports for PHP-FPM and Nginx
EXPOSE 9000

CMD ["php", "-S", "0.0.0.0:9000"]