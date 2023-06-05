FROM php:7.4-apache 

RUN apt-get update 
RUN apt-get install -y git
RUN git clone https://gitlab.int.udd.cl/imendez/osticket_api_round_robin.git 
RUN mv osticket_api_round_robin/* /var/www/html
WORKDIR /var/www/html

EXPOSE 80
