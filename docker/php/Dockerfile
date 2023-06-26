FROM phpdaily/php:8.1.0-dev-fpm-alpine3.13

RUN apk update

WORKDIR /userland/composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --quiet
RUN php composer.phar self-update

RUN mkdir -p /userland/path
RUN mv composer.phar /userland/path/composer

WORKDIR /userland/symfonycli
RUN apk add --no-cache bash
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash -E
RUN apk add symfony-cli

WORKDIR /srv/www
