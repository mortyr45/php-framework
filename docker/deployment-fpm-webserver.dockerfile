FROM alpine:3.13

# ENVS
ENV APACHE_SERVER_TOKENS=Full
ENV APACHE_SERVER_ADMIN=example@example.com
ENV APACHE_SERVER_SIGNATURE=EMail
ENV APACHE_SERVER_NAME=localhost:80
ENV APACHE_DOCUMENT_ROOT=/var/www/html
ENV APACHE_ALLOW_OVERRIDE=All
ENV APACHE_DIRECTORY_INDEX=index.php
ENV APACHE_LOG_LEVEL=debug

ENV FPM_BACKEND_HOST=t-fpm
ENV FPM_BACKEND_PORT=9000

# SETUP BASIC IMAGE
STOPSIGNAL SIGWINCH
EXPOSE 80

COPY --chown=www-data:www-data build/httpd-foreground /usr/local/bin
RUN chmod 100 /usr/local/bin/httpd-foreground
CMD ["httpd-foreground"]

# INSTALL APACHE
RUN apk add --no-cache \
	apache2 \
	apache2-proxy

# SETUP APACHE CONFIG
RUN sed -ri -e 's/ServerTokens OS/ServerTokens ${APACHE_SERVER_TOKENS}/g' /etc/apache2/httpd.conf
RUN sed -ri -e 's/ServerAdmin you@example.com/ServerAdmin ${APACHE_SERVER_ADMIN}/g' /etc/apache2/httpd.conf
RUN sed -ri -e 's/ServerSignature On/ServerSignature ${APACHE_SERVER_SIGNATURE}/g' /etc/apache2/httpd.conf
RUN sed -ri -e 's/#ServerName www.example.com:80/ServerName ${APACHE_SERVER_NAME}/g' /etc/apache2/httpd.conf
RUN sed -ri -e 's!/var/www/localhost/htdocs!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/httpd.conf
RUN sed -ri -e 's/AllowOverride None/AllowOverride ${APACHE_ALLOW_OVERRIDE}/g' /etc/apache2/httpd.conf
RUN sed -ri -e 's/DirectoryIndex index.html/DirectoryIndex ${APACHE_DIRECTORY_INDEX}/g' /etc/apache2/httpd.conf
RUN sed -ri -e 's/LogLevel warn/LogLevel ${APACHE_LOG_LEVEL}/g' /etc/apache2/httpd.conf

# APACHE MODS
RUN sed -ri -e 's!#LoadModule rewrite_module modules/mod_rewrite.so!LoadModule rewrite_module modules/mod_rewrite.so!g' /etc/apache2/httpd.conf

# COPY PUBLIC CONTENT
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
COPY --chown=www-data:www-data src/public /var/www/html/public
COPY --chown=www-data:www-data build/.htaccess /var/www/html/public/.htaccess