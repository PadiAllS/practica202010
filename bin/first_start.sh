#!/bin/bash

docker-compose exec app composer install
docker-compose exec app chmod 777 ./web/assets -R
docker-compose exec app chmod 777 .runtime -R 
docker-compose exec app chmod 777 ./ -R
docker-compose exec app yii migrate --migrationPath=@yii/rbac/migrations --interactive=0
docker-compose exec app yii migrate/up --interactive=0

