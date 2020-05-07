# E-Learning

## Project setup

1. Clone this project then copy and rename env-file.

```shell
git clone <Paste project URL or Use SSH>
cd elearning_app
cp .env.sample .env
```

**After that, edit `.env` to your environment.**

2. Build container and run the docker-compose.

```shell
docker-compose up -d --build
```

3. Enter to `app` container and run these command.

```shell
cd elearning_app
composer install
php artisan key:generate
php artisan migrate
```

4. Application will expose to `localhost:8005`.
