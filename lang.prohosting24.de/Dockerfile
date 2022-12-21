FROM git.internal.prohosting24.de:5005/ph24-images/php7.4-nginx:latest

ADD index.php /opt/app/index.php

ADD nginx.conf /etc/nginx/sites-available/default
ADD config.json.prod /opt/app/config.json
RUN chown -R www-data:www-data /opt/app/

CMD service php7.4-fpm start && nginx -g 'daemon off;'
