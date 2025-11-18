# Use official PHP Apache image
FROM php:8.2-apache

# Enable Apache modules
RUN a2enmod rewrite

# Copy project files into container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Set permissions for pages folder
RUN chmod -R 755 /var/www/html/pages

# Allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Expose port for Render
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
