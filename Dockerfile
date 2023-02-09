FROM strongpapazola/ubuntu:template-web-php7.4-laravel
RUN rm -rf /var/www/html/*
COPY . /var/www/html/
WORKDIR /var/www/html/
RUN curl --silent --show-error "https://getcomposer.org/installer" | php -- --install-dir=/usr/local/bin --filename=composer; \
composer install; \
chmod -R 775 ./; \
chown -R www-data:www-data ./; \
cp .env.example .env; \
./artisan key:generate; 
#RUN rm /var/www/html/application/config/config.php;\
#rm -rf /var/www/html/.git*;
#COPY CONFIG_PROD/config.php /var/www/html/application/config/config.php
#COPY CONFIG_PROD/hooks.php /var/www/html/application/config/hooks.php

CMD apachectl -D FOREGROUND
