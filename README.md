# Vehicle app

## Requirements
- Mysql Database
- PHP8.1
- Composer
- npm

#### note
This application build with laravel framework you neew laravel 10 requirements to run this application

## Installation
- clode application from this github
- copy `.env.example` and paste it on the same directory and rename it to `.env`
- setup `.env` and fiil these variables `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` for database configurations, and these variables `DEFAULT_ROOT_PASS`, `DEFAULT_ADMIN_PASS`, `DEFAULT_STAFF_PASS` for defaul login password
- remaping project classes with composes command `composer dump-autoload`
- install dependencies using composer with command `composer install`
- migrate database tables `php artisan migrate` or `php artisan migrate:fresh`
- seed database with comand `php artisan db:seed`
- root login username `root` password same with `DEFAULT_ROOT_PASS` so do for admin `DEFAULT_ADMIN_PASS` and staff `DEFAULT_STAFF_PASS`, for username or email shoud check it on database
