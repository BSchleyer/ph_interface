FROM ubuntu:18.04

ADD . /opt/app

RUN apt update
RUN apt upgrade -y
RUN apt install software-properties-common -y
RUN add-apt-repository ppa:ondrej/php
RUN apt update
RUN apt install php7.4-fpm -y
RUN apt install php7.4-curl php7.4-pgsql php7.4-mbstring -y
WORKDIR /opt/app
ADD config.json.prod /opt/app/src/configs/config.json
EXPOSE 80
CMD service php7.4-fpm start && php main.php
