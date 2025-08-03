FROM unit:1.34.1-php8.3

RUN apt update && apt install -y \
    curl unzip git libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pcntl opcache pdo pdo_mysql intl zip gd exif ftp bcmath \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/*

RUN { \
    echo "opcache.enable=1"; \
    echo "opcache.jit=tracing"; \
    echo "opcache.jit_buffer_size=256M"; \
    echo "memory_limit=512M"; \
    echo "upload_max_filesize=64M"; \
    echo "post_max_size=64M"; \
} > /usr/local/etc/php/conf.d/custom.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

COPY --chown=unit:unit . .

RUN composer install --prefer-dist --optimize-autoloader --no-interaction

RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY --chown=unit:unit unit.json /docker-entrypoint.d/config.json

EXPOSE 8000

CMD ["unitd", "--no-daemon"]
