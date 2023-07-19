# Dockerfile
FROM php:7.4-apache

# Instalação das dependências e extensões do PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql zip

# Instalação da extensão Redis
RUN pecl install redis && docker-php-ext-enable redis

# Instalação da extensão MongoDB
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Habilita o módulo rewrite do Apache
RUN a2enmod rewrite

# Copia o arquivo php.ini personalizado para o contêiner
COPY ./config/php.ini /usr/local/etc/php/conf.d/custom.ini

# Diretório de trabalho para o PHP
WORKDIR /var/www/html

# Expondo a porta 80 para se comunicar com o servidor Apache
EXPOSE 80
