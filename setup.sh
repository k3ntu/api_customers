#! /bin/bash

sudo docker-compose up -d
sudo docker-compose run --rm composer install
sudo docker-compose run --rm artisan migrate
sudo docker-compose run --rm artisan passport:install

sudo docker-compose run --rm npm install
sudo docker-compose run --rm npm dev