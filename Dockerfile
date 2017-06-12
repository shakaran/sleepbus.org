FROM php:5-apache

RUN a2enmod rewrite

RUN touch /var/log/apache2/php_err.log && chown www-data:www-data /var/log/apache2/php_err.log
COPY config/php.ini /usr/local/etc/php/

RUN apt-get update \
&& apt-get install -y inotify-tools rsync mysql-client zlib1g-dev \
&& docker-php-ext-install zip mysql mysqli pdo pdo_mysql

COPY *.sh /
COPY seed_data /seed_data

COPY environment_config-sample.ini /var/www/environment_config.ini
RUN chown www-data:www-data /var/www/environment_config.ini

