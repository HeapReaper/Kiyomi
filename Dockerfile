FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

RUN a2enmod rewrite

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n\tAllowOverride All\n</Directory>' >> /etc/apache2/apache2.conf

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

COPY . .

COPY php.ini /usr/local/etc/php/conf.d/custom.ini

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chmod 644 /var/www/html/public/.htaccess
RUN chmod 755 /var/www/html/public
RUN chmod 755 /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
