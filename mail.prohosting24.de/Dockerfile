FROM git.internal.prohosting24.de:5005/ph24-images/php7.4-nginx:latest

COPY . /opt/app/

ADD config.json.prod /opt/app/config.json
RUN chown -R www-data:www-data /opt/app/
WORKDIR /opt/app
CMD php main.php
