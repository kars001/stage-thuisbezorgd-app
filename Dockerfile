FROM dunglas/frankenphp:php8.3-bookworm AS base-php

# Install PHP extensions
RUN install-php-extensions \
    pdo_mysql \
    pdo_sqlsrv \
    sqlsrv \
    redis \
    zip \
    pcntl \
    sockets \
    gd \
    intl

# Build PHP
FROM base-php AS build-php
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /app
WORKDIR /app
RUN composer install --no-dev --optimize-autoloader && \
    php artisan octane:install --server=frankenphp

# Build Javascript
FROM node AS build-javascript
WORKDIR /app
ADD . /app
COPY --from=build-php /app/vendor /app/vendor
RUN npm i && npm run build


# Build final container
FROM base-php
RUN groupadd -g 1000 app \
     && useradd -u 1000 -g app -M -s /usr/sbin/nologin app \
     && chown app:app /app \
     && setcap -r /usr/local/bin/frankenphp

COPY --chown=1000 --from=build-php /app /app
COPY --chown=1000 --from=build-javascript /app/public /app/public

USER app

EXPOSE 8000

CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8000"]
