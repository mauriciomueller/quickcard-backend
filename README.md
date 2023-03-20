## How to start the project:

### Frontend project here:
https://github.com/mauriciomueller/quickcard-frontend
and follow README.md instructions.

### Start containers:
```
$ sail up -d
```
This command starts the Docker containers for your application in the background (detached mode). 
"Sail" is a command-line tool provided by Laravel for managing the Docker environment. 
The -d flag detaches the process and runs the containers in the background.


### Install dependencies:
```
$ sail composer install
```
This command is used to install the dependencies of a Laravel application using Composer, which is a dependency manager for PHP. 
sail composer install runs the composer install command inside a Docker container created by Laravel Sail. 
This ensures that the dependencies are installed consistently across different development environments.


### Generate application key:
```
sail artisan key:generate
```
After executing this command, a unique key will be generated and stored in your .env file as the APP_KEY value. 
Make sure to keep this key secret, as it is crucial for securing your application.

### Run migration with seed
```
$ sail artisan migrate:fresh --seed
```
This command runs the Laravel Artisan command migrate:fresh within the Sail Docker container. 
The migrate:fresh command drops all tables from the database and runs all migrations to recreate the schema. 
The --seed flag tells the command to also run the database seeders after the migrations are complete, populating the database with initial data.

## Other commands

### Stop containers
```
$ sail stop
```
This command stops the running Docker containers for your application. 
It is useful when you want to shut down your development environment temporarily without removing the containers.

### Run tests:
```
$ sail artisan test
```
This command runs your Laravel application's tests within the Sail Docker container using the built-in testing framework (PHPUnit). 
It executes all test cases defined in your application and reports the results.

### Run artisan commands if sail alone is not working:
```
$ ./vendor/bin/sail artisan [your_command]
```
