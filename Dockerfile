# Base PHP image (ensure ARM64 build is used)
FROM --platform=linux/arm64 php:8.2-fpm AS base

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    git \
    curl \
    unzip \
    zip \
    nodejs \
    npm \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer (ARM64 compatible)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy config files
COPY php.ini /usr/local/etc/php/php.ini
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy package files & build assets
COPY package*.json ./

RUN npm install

# Copy Laravel source and set ownership
COPY --chown=www-data:www-data . .

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 80

# Use supervisor to start PHP-FPM + Nginx
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
