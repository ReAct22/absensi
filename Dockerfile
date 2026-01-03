FROM php:8.3-fpm

# ===============================
# Install system dependencies
# ===============================
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nano \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ===============================
# Install PHP extensions
# ===============================
RUN docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip

# ===============================
# Install Composer
# ===============================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ===============================
# Set working directory
# ===============================
WORKDIR /var/www/html

# ===============================
# Copy existing app files (optional)
# ===============================
# COPY . .

# ===============================
# Permissions
# ===============================
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
