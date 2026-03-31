# docker/php/Dockerfile
# PHP 8.2 FPM with all extensions needed by Laravel 11

FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    oniguruma-dev \
    icu-dev \
    libzip-dev \
    nodejs \
    npm

# Install PHP extensions required by Laravel
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    xml \
    intl \
    zip

# Install Composer (official image trick — copies the binary)
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Create a non-root user to run the app (security best practice)
RUN addgroup -g 1000 appgroup && adduser -u 1000 -G appgroup -s /bin/bash -D appuser

# Set working directory
WORKDIR /var/www/html

# Give ownership to the non-root user
# Also pre-create directories that will be used as named volumes so they get
# correct ownership even on a fresh volume (Docker volumes default to root:root).
RUN chown -R appuser:appgroup /var/www/html && \
    mkdir -p /var/www/html/vendor /var/www/html/bootstrap/cache /var/www/html/storage && \
    chown -R appuser:appgroup /var/www/html/vendor /var/www/html/bootstrap/cache /var/www/html/storage

USER appuser
