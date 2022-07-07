FROM php:8.1-apache

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y \
        libzip-dev \
        unzip \
        postgresql-server-dev-13 \
    && docker-php-ext-install \
        zip \
        pdo_mysql \
        bcmath \
        pdo \
        pdo_pgsql

RUN apt-get install -y \
        libcurl4-openssl-dev \
        pkg-config \
        libssl-dev

RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir /etc/apache2/ssl \
    && openssl req \
        -new \
        -newkey rsa:4096 \
        -days 365 \
        -nodes \
        -x509 \
        -subj "/C=PL/ST=Mazowieckie/L=Siedlce/O=xxx/CN=fitcalc.local" \
        -keyout /etc/apache2/ssl/apache.key \
        -out /etc/apache2/ssl/apache.crt

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && echo "ServerTokens Prod" >> /etc/apache2/apache2.conf \
    && echo "ServerSignature Off" >> /etc/apache2/apache2.conf \
    && a2enmod rewrite ssl \
    && service apache2 restart

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN pecl install mongodb \
    &&  echo "extension=mongodb.so" > $PHP_INI_DIR/conf.d/mongo.ini

WORKDIR /var/www/fc-app

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
    && apt-get install -y nodejs
