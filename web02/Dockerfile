FROM php:7.4-apache
COPY src/ /var/www/html/

RUN apt-get update \
        && apt-get install -y libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        && a2enmod rewrite headers remoteip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd zip


RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN service apache2 restart