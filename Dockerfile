FROM php:8.2-fpm-alpine
RUN docker-php-ext-install mysqli
COPY . /app
WORKDIR /app
CMD ["php", "-S", "0.0.0.0:80", "-t", "."]
