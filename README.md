## About PackBoss

PackBoss created to fulfill a task of Advanced Database subject.
PackBoss is a delivery service that help you to send any goods that you have, you can send your goods to across nation.

## Contributing

1. Fork this Repository
2. Clone Repository Results of your Fork
```sh
$ git clone https://github.com/{username}/packboss-api.git
```
3. Add upstream to the results of the clone
```sh
$ git remote add upstream https://github.com/AgungPremaditya/packboss-api.git
```
4. Copy file `.env.example` to `.env`:
```sh
$ cp env-example .env
```
5. Install all package
```sh
$ composer install
```
6. Run this command:
```sh
$ php artisan key:generate
$ composer dump-autoload
```
7. Run this command to migrate data to database:
```sh
$ php artisan migrate:fresh && php artisan passport:install
```
