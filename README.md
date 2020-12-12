# api
An API to manage and produce data to mobile and front-end apps.

Before execute the project, you need to have sure if you have docker installed on your machine.

Running the project:
 
 - Copy ```.env.example``` to ```.env```.
 - Run ```docker-compose up --build -d``` to up the api.
 - Run ```docker-compose exec app composer install``` to install project dependencies.
 - Run ```docker-compose exec app php artisan key:generate``` to generate the project key.
