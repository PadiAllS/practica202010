#!/bin/bash

docker-compose exec app2 composer install
docker-compose exec app2 chmod 777 ./web/assets -R
docker-compose exec app2 chmod 777 ./runtime -R 
docker-compose exec app2 chmod 777 ./ -R