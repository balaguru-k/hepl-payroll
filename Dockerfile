FROM php:7.4-apache

LABEL maintainer="Your Company"
LABEL description="HEPL Payroll PHP Application with CodeIgniter"

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libmcrypt-dev \
    wget \
    zip \
    unzip \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite headers

# Set Apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html

# Configure Apache VirtualHost
RUN sed -ri -e 's!/var/www/html!'"${APACHE_DOCUMENT_ROOT}"'!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!'"${APACHE_DOCUMENT_ROOT}"'!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Create necessary directories with proper permissions
RUN mkdir -p application/logs \
    && mkdir -p application/cache \
    && mkdir -p uploads \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 application/logs \
    && chmod -R 777 application/cache \
    && chmod -R 777 uploads

# Create .htaccess for CodeIgniter
RUN echo '<IfModule mod_rewrite.c>\n\
    RewriteEngine On\n\
    RewriteCond %{REQUEST_FILENAME} !-f\n\
    RewriteCond %{REQUEST_FILENAME} !-d\n\
    RewriteRule ^(.*)$ index.php/$1 [L]\n\
</IfModule>' > .htaccess

# Expose port
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
    CMD curl -f http://localhost/index.php || exit 1

# Start Apache
CMD ["apache2-foreground"]
