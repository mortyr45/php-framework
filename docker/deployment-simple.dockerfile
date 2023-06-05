FROM pmp-intermediate

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

COPY --chown=www-data:www-data src/private /var/www/html/private
COPY --chown=www-data:www-data src/public /var/www/html/public