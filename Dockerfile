FROM php:8.2-apache

# Enable required Apache modules
RUN a2enmod rewrite
RUN a2enmod headers

# Set working directory
WORKDIR /var/www/html/

# Copy project files
COPY . /var/www/html/

# Ensure pages folder exists for generated SEO pages
RUN mkdir -p /var/www/html/pages

# Set permissions
RUN chmod -R 755 /var/www/html

# Allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]
