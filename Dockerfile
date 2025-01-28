# Base Image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    sqlite3 \
    libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_sqlite pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set permissions
RUN chown -R www-data:www-data /var/www && chmod -R 775 /var/www

# Copy application code
COPY . /var/www

# Set the default command
CMD ["php-fpm"]
