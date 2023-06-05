#!/bin/bash

docker network create apache-php
docker run --rm -d --network apache-php --name t-fpm t-fpm
docker run --rm -d -p 80:80 --network apache-php --name t-apache t-apache

#docker rm -f t-fpm t-apache