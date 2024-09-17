# Use the official PHP image with Apache
FROM php:8.0-apache

# Enable required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli cifs-utils

# Set the working directory
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y wget unzip sendmail

RUN wget https://github.com/stukerr/baby-photo-uploader/archive/refs/heads/main.zip -O repo.zip && \
    unzip repo.zip && \
    cp -r baby-photo-uploader-main/src/* /var/www/html/ && \
    cp /var/www/html/php.ini /usr/local/etc/php/php.ini && \ 
    rm -rf repo.zip baby-photo-uploader-main

RUN /etc/init.d/apache2 reload
    
# Create the uploads directory
RUN mkdir -p /var/www/html/uploads

# Set permissions so that www-data can write to the directory
RUN chown -R www-data:www-data /var/www/html/uploads \
    && chmod -R 755 /var/www/html/uploads

# Enable and start sendmail service
RUN service sendmail start
