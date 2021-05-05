FROM composer:2.0 AS composer
FROM php:8.0-alpine

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN mkdir -p /app
WORKDIR /app
