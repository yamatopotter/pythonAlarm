FROM php:7.4-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql mcrypt libmcrypt-dev
ADD . /var/www
RUN chown -R www-data:www-data /var/www
