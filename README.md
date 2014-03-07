# Larafolio - Laravel 4 Portfolio, Blog and CMS

`Version: 1.0.0 Stable`

[![Build Status](https://travis-ci.org/Tyloo/LaraFolio.png?branch=master)](https://travis-ci.org/Tyloo/LaraFolio) [![ProjectStatus](http://stillmaintained.com/Tyloo/LaraFolio.png)](http://stillmaintained.com/Tyloo/LaraFolio) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/Tyloo/LaraFolio/badges/quality-score.png?s=a0249b1dc879585ed2f702a7e1ef22c45bdc23d5)](https://scrutinizer-ci.com/g/Tyloo/LaraFolio/) [![Code Coverage](https://scrutinizer-ci.com/g/Tyloo/LaraFolio/badges/coverage.png?s=de47a05dbee416ed3cdb11847836238f8f0bb0c1)](https://scrutinizer-ci.com/g/Tyloo/LaraFolio/)

LaraFolio is a sample Application built with the amazing PHP framework Laravel 4. The main purpose is to create a CMS system with a Blog, a Portfolio, an Admin Panel, a Contact page and dynamic Content pages.

-----
## Features
* Bootstrap 3.1.1
* Custom Error Pages
	* 403 : Forbidden pages
	* 404 : Not Found pages
	* 500 : Internal Server errors
* Front-end
	* User authentication, registration, password retrival
	* User account area : profile and settings management

-----
## Issues
See [GitHub Issue List](https://github.com/Tyloo/LaraFolio/issues) for current list.

-----
## Wiki
[Roadmap](https://github.com/Tyloo/LaraFolio/wiki/Roadmap)

-----
## Requirements
	PHP >= 5.3.0
	MCrypt PHP Extension

-----
##How to install
### Step 1: Get the code
#### Option 1: Git Clone
	git clone git://github.com/Tyloo/LaraFolio.git LaraFolio

#### Option 2: Download the repository
    https://github.com/Tyloo/LaraFolio/archive/master.zip

### Step 2: Use Composer to install dependencies
    cd LaraFolio
	composer install --dev

If you haven't already, you might want to make [composer be installed globally](https://getcomposer.org/doc/00-intro.md#globally) for future ease of use.

Please note the use of the `--dev` flag.

Some packages are required on the development environment to generate migrations, controllers and other stuff.

When you deploy your project on a production environment you will want to upload the ***composer.lock*** file used on the development environment and only run `composer install` on the production server.

This will skip the development packages and ensure the version of the packages installed on the production server match those you developped on.

NEVER run `composer update` on your production server.

### Step 3: Configure Environments

Laravel 4 will load configuration files depending on your environment.

Open ***bootstrap/start.php*** and edit the following lines to match your settings. You want to be using your machine name in Windows and your hostname in OS X and Linux (type `hostname` in terminal). Using the machine name will allow the `php artisan` command to use the right configuration files as well.

    $env = $app->detectEnvironment(array(

        'local' => array('your-local-machine-name'),
        'staging' => array('your-staging-machine-name'),
        'production' => array('your-production-machine-name'),

    ));

Now create the folder inside ***app/config*** that corresponds to the environment the code is deployed in. This will most likely be ***local*** when you first start a project.

You will now be copying the initial configuration file inside this folder before editing it. Let's start with ***app/config/app.php***. So ***app/config/local/app.php*** will probably look something like this, as the rest of the configuration can be left to their defaults from the initial config file:

    <?php

    return array(

        'url' => 'http://larafolio.dev',

        'timezone' => 'UTC',

        'key' => 'YourSecretKey!!!',

        'providers' => array(
        
        [... Removed ...]
        
        /* Uncomment for use in development */
        // 'Way\Generators\GeneratorsServiceProvider', // Laravel Generators

        ),

    );

### Step 4: Configure Database

Now that you have the environment configured, you need to create a database configuration for it. Copy the file ***app/config/database.php*** in ***app/config/local*** and edit it to match your local database settings. You can remove all the parts that you have not changed as this configuration file will be loaded over the initial one.

### Step 5: Configure Mailer

In the same fashion, copy the ***app/config/mail.php*** configuration file in ***app/config/local/mail.php***. Now set the `address` and `name` from the `from` array in ***config/mail.php***. Those will be used to send account confirmation and password reset emails to the users.
If you don't set that registration will fail because it cannot send the confirmation email.

### Step 6: Populate Database
Run these commands to create and populate Users table:

	php artisan migrate
	php artisan db:seed

### Step 7: Set Encryption Key
***In app/config/app.php***

```
/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| This key is used by the Illuminate encrypter service and should be set
| to a random, long string, otherwise these encrypted values will not
| be safe. Make sure to change it before deploying any application!
|
*/
```

	'key' => 'YourSecretKey!!!',

You can use artisan to do this

    php artisan key:generate --env=local

The `--env` option allows defining which environment you would like to apply the key generation. In our case, artisan generates your key in ***app/config/local/app.php*** and leaves ***'YourSecretKey!!!'*** in ***app/config/app.php***. Now it can be generated again when you move the project to another environment.

### Step 8: Make sure app/storage is writable by your web server.

If permissions are set correctly:

    chmod -R 775 app/storage

Should work, if not try

    chmod -R 777 app/storage

### Step 10: Start Page

#### **User login with commenting permission**
Navigate to your LaraFolio website and login at ``/login``:

    username : User
    password : 123456

Create a new user at ``/register``

#### **Admin login**
Navigate to ``/admin``

    username: Admin
    password: 123456

-----
## Application Structure

The structure of this starter site is the same as default Laravel 4 with one exception.
This application adds a `Tyloo` folder. Which, houses application specific library files.
The files within ``Tyloo`` could also be handled within a composer package, but is included here as an example.

### Development

For ease of development you'll want to enable a couple useful packages. This requires editing the `app/config/app.php` file.

```
    'providers' => array(

        [...]

        // Uncomment those lines below for use in development
        //'Way\Generators\GeneratorsServiceProvider', // Laravel Generators
        //'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider', // IDE Helper
        //'Barryvdh\Debugbar\ServiceProvider', // Debug Bar

    ),
```
Uncomment the lines above in order to activate the development tools. Then you'll want to run a composer update with the dev flag.

```
composer update
```
This adds the Laravel Generators.

### Production Launch

By default debugging is enabled. Before you go to production you should disable debugging in `app/config/app.php`

```
    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => false,
```

-----
## Included Package Information

### Laravel 4 Generators

Laravel 4 Generators package provides a variety of generators to speed up your development process. These generators include:

- `generate:model`
- `generate:seed`
- `generate:test`
- `generate:view`
- `generate:migration`
- `generate:resource`
- `generate:scaffold`
- `generate:form`
- `generate:test`

For full usage see [Laravel 4 Generators Readme](https://github.com/JeffreyWay/Laravel-4-Generators/blob/master/readme.md)

-----
## License

This is free software distributed under the terms of the MIT license

## Additional information
Any questions, feel free to [contact me](http://twitter.com/TylooFR).