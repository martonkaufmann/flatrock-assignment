# Setup

* Make sure ports 80 and 443 are available
* docker-compose up -d
* docker-compose exec app php artisan migrate:fresh --seed
* Open ```assignment.flatrocktech.localhost```