## About Project

Product service is a backend application built using the currently very popular framework, [Laravel](https://laravel.com). This application provides modules related to product management, including:

- Product category management.
- Product management along with photos.

## Setup

<strong>Prerequisite:</strong>

- PHP version 8.0
- RDBMS (Mysql or Postgress) optional
- Make you've installed composer in you machine
- Web server (nginx/apache2)

<strong>Installation:</strong>

- Download or clone this project onto your machine
- Open your terminal window and navigate to this project <b>dir</b>
- Install all the depedencies by running `composer install`
  - > If you have some problem with the installation step, make sure you read the [composer](https://composer.com) documentation.
- After the composer installation finished, setup the environment variable that will be use by the framewoek. Copy `.env.example` file and rename it as `.env`
- Generate the application key by running `php artisan key:generate`
- Next you need to update some values that are in `.env` file that you just copied. The list below are some values that need to be changing
  - >   DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_db_name
        DB_USERNAME=root
        DB_PASSWORD=
        DB_SEED_CATEGORIES= # number
        DB_SEED_PRODUCTS= # number
        DB_SEED_IMAGES= # number
  - These values (`DB_SEED_CATEGORIES`, `DB_SEED_PRODUCTS`, `DB_SEED_IMAGES`) is used to determine how many data that will be generated when you run database seeders. If there is no value for those keys then it won't create any records into the database.
- After all those values are filled, run the migration to get the database ready. `php artisan migrate` or if you want to also using seeders than just run this command `php artisan migrate --seed`
- Then run the application, by executing this command `php artisan serve`.
- In order to get the all available endpoints of this project just run `php artisan route:list --path api`

## Automatic Testing

In order to makes the automatic testing you need to do following setup below:

- Create `.env.testing` file by copying `.env.example`
- Setup your database env for testing
- Set the value of `APP_ENV=testing` inside `.env.testing` file
- Before run the test cases make sure you've clear the application `config` & `cache` by simple run `php artisan config:clear --env testing && php artisan cache:clear --env testing`
- Run the test cases
  - Run a single test case
    - ```php artisan test --filter {TEST_CLASS_NAME}```
  - Run test case group
    - ```php artisan test --filter {folder_name}```
  - Run all available test cases
    - ```php artisan test```

## References

- Official [Laravel](https://laravel.com/docs/9.x) documentation.
- [Composer](https://getcomposer.org/doc/)
- Web servers [NGINX](https://docs.nginx.com/), [Apache](https://httpd.apache.org/docs/)
- [PHP Docs](https://www.php.net/docs.php)
- [PHP Unit](https://docs.phpunit.de/en/9.6/)