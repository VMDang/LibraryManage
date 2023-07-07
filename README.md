<img src="./public/img/LibraryLogo.png" height="100"> 

# LIBRARY MANAGE

[![GitHub stars](https://img.shields.io/github/stars/VMDang/LibraryManage?style=social)](https://github.com/VMDang/LibraryManage/stargazers) [![GitHub forks](https://img.shields.io/github/forks/VMDang/LibraryManage?style=social)](https://github.com/VMDang/LibraryManage/stargazers)  [![GitHub license](https://img.shields.io/github/license/gothinkster/laravel-realworld-example-app.svg)](https://raw.githubusercontent.com/gothinkster/laravel-realworld-example-app/master/LICENSE)

> ### Library management project with feature such as Security, Authencation, Authorization, CRUD user, book, category,... supporting procedures for borrowing and returning books.
>### See more features and details about the source code in [Library Manage](https://github.com/VMDang/LibraryManage).
### In this project, i used HTML, CSS, jQuery, AdminLTE 3.2, PHP, Laravel 8, MySQL, Docker

This repo is functionality complete — PRs and issues welcome!

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start [Laravel 8 Documentation](https://laravel.com/docs/8.x). Necessary settings before starting as PHP >= 7.3, NodeJS, Composer

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

1. Clone the repository

        git clone https://github.com/VMDang/LibraryManage.git

2. Switch to the repo folder

        cd LibraryManage

3. Install all the dependencies using composer and npm

        composer install
        npm install

4. Copy the example env file and make the required configuration changes in the .env file

        cp .env.example .env
> Please contact me via [Mail](mailto:dang.vm205063@sis.hust.edu.vn) to know more about the content in the .env file
5. Generate a new application key

        php artisan key:generate

6. Run the database migrations (**Set the database connection in .env before migrating**)

        php artisan migrate

7. Run database seeders
   
        php artisan db:seed     
8. Start the local development server

        php artisan serve

You can now access the server at http://localhost:8000

## Database seeding

**Populate the database with seed data with relationships which includes users, roles, permission, books, category,... This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    
## Docker
> Docker is not complete, I will be back to update when the project is done
> 
To install with [Docker](https://www.docker.com), run following commands:

```
git clone https://github.com/VMDang/LibraryManage.git
cd LibraryManage
cp .env.example.docker .env
docker run -v $(pwd):/app composer install
cd ./docker
docker-compose up -d
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan migrate
docker-compose exec php php artisan db:seed
docker-compose exec php php artisan serve --host=0.0.0.0
```


## Main Folders
***Note***: Only the main folders containing important code are mentioned, there are still a few folders that have not been mentioned
- `app/Models` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the controllers
- `app/Http/Middleware` - Contains the auth middleware
- `app/Http/Requests` - Contains all the api form requests
- `app/Providers` - Contains all the providers
- `app/BaseHelper.php` - Contains all the function self-defining to help code Controller
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `public/themes` - Contains source code AdminLTE 3.2
- `public/img` - Contains all the images project
- `public/js` - Contains all the files javascript
- `resources/views` - Contains all the filw view blade
- `routes/auth.php` - Contains route with auth feature
- `routes/web.php` - Contains all route feature
- `storage` - Storage all file in here
- `tests` - Contains all the application tests

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

-------
# Developed team information

## About project
Initially the project was developed for personal purposes. But then I had a lot more teammates to do the same. It became the project of one of my subjects at HUST
> Thanks to the whole team for helping me complete this project. It's an honor to be your leader.
### This is my team
|       Name        | University    | Role   | Contact  |
|-------------------|    :----:     |--------|----------|
| Vu Minh Dang      | HUST          | Leader |          |
| Nguyen Duy Hung   | HUST          | Member |          |
| Ngo Viet Bach     | HUST          | Member |          |
| Ta Van Hoan       | HUST          | Member |          |
| Mac Van Khanh     | HUST          | Member |          |
| Nguyen The Thuong | HUST          | Member |          |
---------
## About me
### **Vu Minh Dang**
#### Hanoi University of Science and Technology - HEDSPI
Mail : [dang.vm205063@sis.hust.edu.vn](mailto:dang.vm205063@sis.hust.edu.vn)
