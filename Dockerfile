# Use the official PHP Apache image
FROM php:7.4-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy custom Apache configuration (optional)
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html


# Set the working directory
WORKDIR /var/www/html

# Copy your website files to the container
COPY . .


# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html/api

# Install dependencies with Composer
RUN composer install


# Set the working directory
WORKDIR /var/www/html

# Expose port 80 for HTTP traffic
EXPOSE 80
