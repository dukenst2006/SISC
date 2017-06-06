#!/bin/bash

cd laradock

docker-compose exec workspace ./vendor/phpunit/phpunit/phpunit
