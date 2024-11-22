FROM php:8.2.26-cli-alpine3.20

RUN apk add --no-cache \
    bash \
    git \
    zip \
    unzip \
    curl \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    postgresql-dev \
    && docker-php-ext-install \
    intl \
    mbstring \
    xml \
    pdo_pgsql \
    pgsql

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . . 

RUN composer install

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "/app/router.php"]
