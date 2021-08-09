#!/bin/bash

docker-compose exec app2 composer install
docker-compose exec app2 chmod -R 777  ./web/assets
docker-compose exec app2 chmod -R 777  ./runtime
docker-compose exec app2 php yii migrate --interactive=0

#docker-compose exec app2 chmod 777 ./ -R
