<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

## Development Mode

I recommend to use this repo with Homestead, the installation steps are in the following link: [Homestead Installation and Setup](https://laravel.com/docs/11.x/homestead#installation-and-setup).

After running the application in Homestead, you need to follow the following commands:

```bash
vagrant ssh
cd code
php artisan migrate
```

## Production Mode

To run the application in production you need to setup the app in Nginx/Apache and install Docker and Docker composer [Get Docker](https://docs.docker.com/get-docker/) [Install the Compose plugin](https://docs.docker.com/compose/install/)
Then run the following command in the root folder

```bash
cp .env.example .env
```

Set the following variables ```DB_HOST``` ```DB_PORT``` (as 54321 if you dont modify the docker-compose.yml file) ```DB_DATABASE``` ```DB_USERNAME``` ```DB_PASSWORD``` 

Finally run
```bash
php artisan key:generate
docker compose up -d
```