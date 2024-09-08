# Use the official PHP image with Apache
FROM php:8.0-apache

# Enable required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Set the working directory
WORKDIR /var/www/html

# Copy the application files into the container
#COPY src/ /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/uploads
