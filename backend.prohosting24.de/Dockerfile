FROM git.internal.prohosting24.de:5005/ph24-images/php7.4-nginx:latest

ADD src/ /opt/app/src/
ADD vendor/ /opt/app/vendor/
ADD index.php /opt/app/index.php
ADD v1.php /opt/app/v1.php

ADD nginx.conf /etc/nginx/sites-available/default
ADD config.json.prod /opt/app/src/configs/config.json
RUN chmod -R 777 /opt/app/vendor/ezyang/htmlpurifier/library/HTMLPurifier/DefinitionCache/Serializer/
RUN chown -R www-data:www-data /opt/app/vendor/ezyang/htmlpurifier/library/HTMLPurifier/DefinitionCache/Serializer/
RUN chown -R www-data:www-data /opt/app/src/*
ADD www.conf /etc/php/7.4/fpm/pool.d/www.conf
ADD php.ini /etc/php/7.4/fpm/php.ini
EXPOSE 80
CMD service php7.4-fpm start && nginx -g 'daemon off;'
