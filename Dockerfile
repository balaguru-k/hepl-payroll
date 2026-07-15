FROM php:7.4-apache

LABEL maintainer="Your Company"
LABEL description="HEPL Payroll PHP Application"

# Install system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    && docker-php-ext-install \
        mysqli \
        pdo \
        pdo_mysql \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies (only if composer.json exists)
RUN if [ -f composer.json ]; then \
        composer install --no-dev --optimize-autoloader; \
    fi

# Create writable directories
RUN mkdir -p application/logs application/cache uploads && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 application/logs application/cache uploads

# Expose Apache port
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=10s --retries=3 \
CMD curl -f http://localhost/ || exit 1

CMD ["apache2-foreground"]
