FROM php:8.5-apache

ARG joomla_version=6.2.1
RUN apt-get update \
    && apt-get install -y --no-install-recommends curl unzip libicu-dev libonig-dev libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" gd intl mbstring pdo_mysql zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*
RUN curl -fsSL "https://github.com/joomla/joomla-cms/releases/download/${joomla_version}/Joomla_${joomla_version}-Stable-Full_Package.zip" -o /tmp/joomla.zip \
    && unzip -q /tmp/joomla.zip -d /var/www/html \
    && rm /tmp/joomla.zip \
    && chown -R www-data:www-data /var/www/html
RUN echo 'SetEnvIf X-Forwarded-Proto https HTTPS=on' > /etc/apache2/conf-enabled/tunnel-https.conf
