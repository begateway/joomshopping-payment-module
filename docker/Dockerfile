ARG joomla
FROM joomla:${joomla}

RUN apt-get update && \
    apt-get install -y --no-install-recommends curl unzip wget vim less && \
    rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" && \
    php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm /tmp/composer-setup.php

RUN composer global require --working-dir=/usr/local/ joomlatools/console

COPY bashrc /etc/profile.d/bashrc.sh

VOLUME /var/www/html
