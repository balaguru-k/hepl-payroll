FROM php:7.4-apache

LABEL maintainer="Your Company"
LABEL description="HEPL Payroll PHP Application"

# 1. Install system packages and PHP extensions (All combined into one clean step)
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

# 2. Enable Apache rewrite module & allow routing overrides
RUN a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# 3. Configure PHP limits securely (Replaces the .htaccess rules safely)
RUN echo "upload_max_filesize = 200M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 200M" >> /usr/local/etc/php/conf.d/uploads.ini

# 4. Set working directory
WORKDIR /var/www/html

# 5. Copy project files
COPY . .

# 6. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 7. Create writable directories and secure permissions
RUN mkdir -p application/logs application/cache uploads && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 application/logs application/cache uploads

# 8. Expose Apache port
EXPOSE 80

# 9. Healthcheck diagnostic probe
HEALTHCHECK --interval=30s --timeout=10s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

CMD ["apache2-foreground"]
