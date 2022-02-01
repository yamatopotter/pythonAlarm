FROM php:7.4-apache
RUN apt-get update && apt-get install -y libmcrypt-dev
RUN pecl install mcrypt-1.0.4
RUN docker-php-ext-enable mcrypt
RUN docker-php-ext-install mysqli pdo pdo_mysql
ADD . /var/www
RUN chown -R www-data:www-data /var/www
