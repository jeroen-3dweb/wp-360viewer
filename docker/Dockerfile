FROM wordpress:7.1

WORKDIR /var/www/html
RUN pecl install xdebug-3.3.2 \
    && docker-php-ext-enable xdebug \
    && apt-get update \
    && apt-get install nano \
    && export TERM=xterm

COPY ./config/xdebug.ini ../../../usr/local/etc/php/conf.d/xdebug.ini