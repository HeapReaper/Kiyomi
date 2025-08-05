FROM unit:1.34.1-php8.3

RUN apt update && apt install -y \
    curl unzip git libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libssl-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pcntl opcache pdo pdo_mysql intl zip gd exif ftp bcmath \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/*

RUN apt update && apt install -y \
    wkhtmltopdf \
    xfonts-75dpi \
    xfonts-base \
    fontconfig \
    libxrender1 \
    libxext6 \
    libjpeg62-turbo

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

# Create home directory for 'unit' user and set ownership
RUN mkdir -p /home/unit && chown unit:unit /home/unit

USER unit
ENV HOME=/home/unit

RUN npm install && npm run build

USER root

RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY --chown=unit:unit unit.json /docker-entrypoint.d/config.json

RUN apt update && apt install -y supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf


EXPOSE 8000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]