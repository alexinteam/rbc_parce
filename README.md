##Build 

docker network create rbcnetwork

docker-compose up -d

docker-compose exec app composer install

docker-compose exec app php artisan migrate

docker-compose exec app php artisan key:generate

##Run command

docker-compose exec app php artisan parce:rbc

##Navigate

http://localhost
