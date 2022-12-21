FROM git.internal.prohosting24.de:5005/ph24-images/php7.4-nginx:latest


ADD . /opt/app

ADD nginx.conf /etc/nginx/sites-available/default
ADD config.json.prod /opt/app/src/configs/config.json
ADD www.conf /etc/php/7.4/fpm/pool.d/www.conf
ADD php.ini /etc/php/7.4/fpm/php.ini
RUN chown -R www-data:www-data /opt/app/
EXPOSE 80
CMD service php7.4-fpm start && nginx -g 'daemon off;'
