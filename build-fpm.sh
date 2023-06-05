#!/bin/bash

docker build -f docker/deployment-fpm-backend.dockerfile -t t-fpm .
docker build -f docker/deployment-fpm-webserver.dockerfile -t t-apache .