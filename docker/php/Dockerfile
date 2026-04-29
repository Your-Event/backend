# =========================
# PHP 8.4 FPM (Laravel)
# =========================
FROM php:8.4-fpm

# =========================
# Working directory
# =========================
WORKDIR /var/www/html

# =========================
# System dependencies
# =========================
RUN apt-get update && apt-get install -y \
    git curl unzip zip vim supervisor cron \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    libfreetype6-dev libjpeg62-turbo-dev libwebp-dev \
    libmagickwand-dev jpegoptim optipng pngquant gifsicle \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd pdo_mysql mbstring exif pcntl bcmath zip intl

# =========================
# PECL extensions
# =========================
RUN pecl install redis imagick \
    && docker-php-ext-enable redis imagick

# =========================
# Composer
# =========================
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# =========================
# Copy application
# =========================
COPY --chown=www-data:www-data ./backend /var/www/html

# =========================
# Install PHP dependencies (AS ROOT FIRST)
# =========================
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# =========================
# Permissions fix
# =========================
RUN chown -R www-data:www-data /var/www/html

# =========================
# Supervisor config
# =========================
COPY docker/php/supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# =========================
# Entrypoint: fix bind-mount ownership, then drop to www-data
# =========================
COPY docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# =========================
# Port
# =========================
EXPOSE 9000

# =========================
# Start PHP-FPM + queue worker
# =========================
ENTRYPOINT ["/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisor.conf"]