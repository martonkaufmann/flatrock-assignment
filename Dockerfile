FROM php:8.1.5-fpm

WORKDIR /var/www/app

RUN apt-get update && apt-get install -y \
    zip unzip ssh git

RUN pecl install xdebug-3.1.4 &&\
    docker-php-ext-enable xdebug &&\
    docker-php-ext-install \
    pdo_mysql

RUN curl https://getcomposer.org/installer | php -- --version=2.3.5 &&\
    mv composer.phar /usr/local/bin/composer

RUN echo "xdebug.mode=debug" >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini &&\
    echo "xdebug.client_host=host.docker.internal" >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" &&\
    echo "max_input_vars=12" >> $PHP_INI_DIR/php.ini &&\
    echo "post_max_size=2K" >> $PHP_INI_DIR/php.ini &&\
    echo "memory_limit=128M" >> $PHP_INI_DIR/php.ini &&\
    echo "file_uploads=Off" >> $PHP_INI_DIR/php.ini &&\
    echo "date.timezone = Europe/Budapest" >> $PHP_INI_DIR/php.ini

COPY . .

RUN composer install --no-interaction