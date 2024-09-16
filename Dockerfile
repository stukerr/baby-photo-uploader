# Use the official PHP image with Apache
FROM php:8.0-apache

# Enable required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Set the working directory
WORKDIR /var/www/html

RUN wget https://github.com/stukerr/baby-photo-uploader/archive/refs/heads/main.zip -O repo.zip && \
    unzip repo.zip && \
    mv baby-photo-uploader-main/src /src && \
    rm -rf repo.zip your-repository-main

# Copy the application files into the container
COPY src/ /var/www/html/

# Create the uploads directory
RUN mkdir -p /var/www/html/uploads

# Set permissions so that www-data can write to the directory
RUN chown -R www-data:www-data /var/www/html/uploads \
    && chmod -R 755 /var/www/html/uploads

# Add sendmail package
RUN apt-get update && apt-get install -y sendmail

# Enable and start sendmail service
RUN service sendmail start
