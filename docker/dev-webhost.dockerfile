FROM php:7.4.16-apache

# Environment variables
ENV APACHE_DOCUMENT_ROOT=/var/www/html/src/public

# Server setup
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf
RUN a2enmod rewrite
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

# PHP extensions
# RUN docker-php-ext-install pdo_mysql
# RUN pecl install mongodb-1.8.2 && docker-php-ext-enable mongodb