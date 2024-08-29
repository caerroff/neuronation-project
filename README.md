# Neuronation Project
## Installing the project

### Requirements
The project requires docker/docker-compose.
The other requirements (php, composer etc...) will be installed inside our docker.

### Installing the dependencies
Once cloned, we can create the Docker

>`docker-compose build app`

Will create the image for the app docker (which we can use to run commands like `php artisan`)

After this, we can start our docker.

>`docker-compose up -d`

Once started, we have our application running.

After starting the docker, make sure to run 

>`docker exec -it neuronation-app composer install`

It will install the `/vendor`, containing all dependencies.

### Creating the database

Once the docker is started, we have to configure our application to use the database, and then migrate.

First, create a `.env` file containing these lines:
```
DB_CONNECTION=mysql
DB_HOST=neuronation-db
DB_PORT=3306
DB_DATABASE=neuronation
DB_USERNAME=neuronation
DB_PASSWORD=n3ur0n4t10n
```

Once done, execute a migration from the app container

>`docker exec -it neuronation-app php artisan migrate`

### Generating the APP_KEY

To generate the APP_KEY variable in the `.env` file, you can run this command

>`php artisan key:generate`

## Using the API

### First step
The first address you want to visit is the `/initDb` route, which will create dummy entities, so you can check the API working.

Once you see the 'All entities created successfully' message, you can go to the next section

### Using the API
The API route is located at `/api/progress/{userId}`
If you just generated the entities, the `userId` should be 1, 2 and 3.
