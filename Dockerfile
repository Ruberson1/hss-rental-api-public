# Versão da Imagem Docker PHP
FROM php:8.2.1-fpm

# X-debug
COPY 90-xdebug.ini "${PHP_INI_DIR}/conf.d"
RUN pecl install xdebug-3.2.0
RUN docker-php-ext-enable xdebug

## Diretório da aplicação
ARG APP_DIR=/var/www/app


RUN apt-get update && apt-get install nano -y


RUN apt-get update
RUN apt-get install -y --no-install-recommends apt-utils


### apt-utils é um extensão de recursos do gerenciador de pacotes APT
RUN apt-get install -y --no-install-recommends supervisor
COPY ./docker/supervisord/supervisord.conf /etc/supervisor
COPY ./docker/supervisord/conf /etc/supervisord.d/
### Supervisor permite monitorar e controlar vários processos (LINUX)
### Bastante utilizado para manter processos em Daemon, ou seja, executando em segundo plano

# Dependências recomendadas de desenvolvido para ambiente linux
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libpq-dev \
    libxml2-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql session xml intl zip iconv simplexml pcntl gd fileinfo


# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

WORKDIR $APP_DIR
RUN cd $APP_DIR
RUN chown www-data:www-data $APP_DIR

COPY --chown=www-data:www-data ./app .
RUN rm -rf vendor
RUN composer install --no-interaction

RUN apt install nginx -y


COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
## Se for necessário criar os sites disponíveis já na confecção da imagem, então descomente a linha abaixo
COPY ./docker/nginx/sites /etc/nginx/sites-available

RUN apt-get update -y \
    && apt-get install cron -y \
    && echo "* * * * * cd /var/www/app && /usr/local/bin/php artisan schedule:run >> /var/log/cron.log 2>&1" >> /etc/cron.d/scheduler \
    && chmod 644 /etc/cron.d/scheduler \
    && crontab /etc/cron.d/scheduler \

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]