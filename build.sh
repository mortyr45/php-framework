#!/bin/bash

docker build -f docker/dev-webhost.dockerfile -t pmp-intermediate .
docker build -f docker/deployment-simple.dockerfile -t t-simple .
docker image rm pmp-intermediate -f