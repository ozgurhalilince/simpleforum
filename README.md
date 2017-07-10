# Simple Forum
Package for Laravel 5.4
demo url: https://simpleforum.000webhostapp.com/ozgurince/simpleforum

### Features
  - Users can sign up and sign in.
  - Users can show all of forum pages.
  - Members can create conversations with files.
  - Members can reply existing conversations with files.
  - Members can update and delete own comments and posts.
  - Members can like comments.
  - Members can update their informations (name, email. password, profile photo etc.)
  - Admins also has members' permissions.
  - Admins can ban members.

### Installation
1.- Download the package
```sh
composer require ozgurince/simpleforum
```

2.- After installing this package, you have to set the service provider on your config/app.php file
```sh
Ozgurince\Simpleforum\SimpleForumServiceProvider::class
```

3.- Create migrations for the simpleforum, make sure you have a migration already created for users and seed your users and roles tables.
```sh
php artisan migrate

php artisan db:seed --class=Ozgurince\Simpleforum\Seeds\RolesTableSeeder 
                                                                          
php artisan db:seed --class=Ozgurince\Simpleforum\Seeds\UsersTableSeeder
```

4.- Publish the assests to your public folder.
```sh
php artisan vendor:publish --tag=public --force
```

5.- Add your $routeMiddleware variable in Kernel.php
```sh
'admin' => \Ozgurince\Simpleforum\Middleware\AdminMiddleware::class,
```

6.- Your User model in APP folder must includes functions and $fillable variable of User model of the package

### Contributing
1.- Fork it 
2.- Create your feature branch 
3.- Commit your changes 
4.- Push to the branch
5.- Create a new Pull Request

### License
MIT