FROM php:7.4.16-fpm-alpine3.13

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

COPY --chown=www-data:www-data src/private /var/www/html/private
COPY --chown=www-data:www-data src/public/index.php /var/www/html/public/index.php