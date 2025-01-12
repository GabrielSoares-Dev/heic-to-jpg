FROM php:7.4-cli

RUN apt-get update \
    && apt-get install -y \
    zip \
    unzip \
    git
    
RUN  pecl install xdebug-2.8.1 \
    && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app/heic-to-jpg

COPY . .

EXPOSE 8000

RUN composer self-update

RUN composer i

CMD [ "bash" ]