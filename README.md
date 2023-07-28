# Seleksi 3 Labpro - Monolith Service

## 13521024 - Ahmad Nadil

## How to Run
### Run using php
#### 1. Make sure you have laravel installed
#### 2. Install the dependencies for the laravel project
```
composer install
```

#### 3. Copy the .env.example file and rename it to .env and change the following environment variables to your own
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
BE_URL=
```

#### 4. Migrate the database if you haven't
```
php artisan migrate
```

#### 5. Serve the project
```
php artisan serve
```

### Run using Docker
#### 1. Make sure you have docker installed
#### 2. Run the docker-compose
```
docker-compose up
```

#### 3. Migrate the database if you haven't
```
docker-compose exec php php artisan migrate
```
