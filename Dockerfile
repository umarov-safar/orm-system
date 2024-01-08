FROM php:8.2-fpm

WORKDIR /var/www

# Copy your application files
COPY . .

# Expose ports for PHP-FPM and Nginx
EXPOSE 9000

CMD ["php", "-S", "0.0.0.0:9000"]