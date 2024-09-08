# Use an official PHP image with Apache pre-installed
FROM php:8.0-apache

# Install necessary PHP extensions for file uploads and email functionality
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable mod_rewrite for Apache (if needed)
RUN a2enmod rewrite

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the application source code to the container
COPY src/ /var/www/html/

# Set permissions for the upload folder
RUN mkdir -p /var/www/html/uploads && \
    chown -R www-data:www-data /var/www/html/uploads && \
    chmod -R 755 /var/www/html/uploads

# Expose port 80 for the Apache web server
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
