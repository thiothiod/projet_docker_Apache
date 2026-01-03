FROM php:8.2-apache

ARG VERSION
ENV VERSION=$VERSION

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql
