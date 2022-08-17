FROM --platform=linux/amd64 php:8

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql sockets zip
RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

EXPOSE 8001