FROM php:7.2-fpm-alpine

RUN apk add --no-cache bash vim git \
    openssl \
    libcurl curl curl-dev \
    autoconf gcc g++ make

RUN \
    docker-php-ext-install curl && \
    docker-php-ext-install bcmath

### composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /data
WORKDIR /data

EXPOSE 9000

STOPSIGNAL SIGQUIT

CMD ["php-fpm"]
