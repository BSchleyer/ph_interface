FROM git.internal.prohosting24.de:5005/ph24-images/php7.4-nginx:latest
COPY . /opt/app

ADD nginx.conf /etc/nginx/sites-available/default
ADD config.json.prod /opt/app/src/configs/config.json
EXPOSE 80
CMD service php7.4-fpm start && nginx -g 'daemon off;'
