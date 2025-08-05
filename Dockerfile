FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git unzip curl supervisor wkhtmltopdf nginx iproute2 \
    && docker-php-ext-install pdo_mysql

WORKDIR /var/www/html

COPY . .

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-interaction --optimize-autoloader

# Set PHP-FPM to listen on 9000 TCP socket (default)
RUN sed -i 's|^listen = .*|listen = 9000|' /usr/local/etc/php-fpm.d/www.conf

# Remove default Nginx config
RUN rm /etc/nginx/sites-enabled/default

# Copy custom nginx config
COPY nginx.conf /etc/nginx/sites-enabled/default

# Copy supervisord config
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN chmod -R 755 /var/www/html
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80 9000

CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
