FROM phpdaily/php:8.1.0-dev-fpm-alpine3.13

WORKDIR /userland/composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --quiet

RUN mkdir -p /userland/path
RUN mv composer.phar /userland/path/composer

WORKDIR /srv/www
