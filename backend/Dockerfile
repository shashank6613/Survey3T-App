# Use an official PHP image with Apache
FROM php:8.1-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy the PHP files into the Apache server's root directory
COPY . /var/www/html/

# Expose port 9000
EXPOSE 9000

