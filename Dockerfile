FROM php:8.2-apache

RUN a2enmod rewrite

WORKDIR /var/www/html/

COPY . /var/www/html/

# Create pages folder if it’s missing
RUN mkdir -p /var/www/html/pages

# Set correct file permissions
RUN chmod -R 755 /var/www/html

# Enable .htaccess support
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]
