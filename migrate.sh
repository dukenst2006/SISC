#!/bin/bash

cd laradock

docker-compose exec workspace php artisan migrate:refresh --seed
