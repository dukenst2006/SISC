#!/bin/bash

cd laradock

docker-compose exec workspace php artisan dusk
