FROM php:7.2-fpm

RUN apt-get update \
    && apt-get install -y autoconf file g++ gcc libc-dev make git automake libtool pkg-config curl \
    libicu-dev libmcrypt-dev libxml2 libxml2-dev libssl-dev libcurl4-openssl-dev memcached \
    libpq-dev libmemcached-dev zlib1g-dev librabbitmq-dev librabbitmq4 libldap-dev \
    mc net-tools aptitude mlocate ssh libzip-dev libzip4 \
    --no-install-recommends \
    && export TERM=xterm

RUN apt-get install -y software-properties-common gpg

# Install PHP extensions
RUN docker-php-ext-install intl soap mbstring pdo pdo_mysql zip bcmath mysqli pcntl ldap sockets

RUN echo "date.timezone='Europe/Moscow'" > /usr/local/etc/php/conf.d/10-timezone.ini

CMD ["php-fpm"]