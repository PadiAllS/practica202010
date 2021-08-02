#!/bin/bash

docker-compose exec app2 composer install
docker-compose exec app2 chmod 777 ./web/assets -R
docker-compose exec app2 chmod 777 .runtime -R 
docker-compose exec app2 chmod 777 ./ -R
docker-compose exec app2 yii migrate --migrationPath=@yii/rbac/migrations --interactive=0
docker-compose exec app2 yii migrate/up --interactive=0

