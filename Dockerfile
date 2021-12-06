FROM php:7.4-apache-bullseye

RUN apt-get -y update
RUN apt-get -y install git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer