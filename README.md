<p align="center">
<img src="https://raw.githubusercontent.com/denisbertaglia/series-control/readme/public/img/logomark.svg" width="180" alt="Laravel Logo">
</p>

## Save the series
Series control system written in Laravel 9.

## Features

- Add series with number of seasons and episodes
- Edit series names
- Remove series
- Add seasons with number of episodes
- Remove last season
- Remove last episode
- Mark episodes as watched

## Installation

1. Clone this repository:

```
git clone <https://github.com/denisbertaglia/series-control.git>

```

2. Install project dependencies:

```
composer install

```

3. Create a .env file and configure environment variables:

```
cp .env.example .env

```

4. If using sqlite, modify the .env:

```
DB_CONNECTION=sqlite

```

5. Generate the application key:

```
php artisan key:generate

```

6. Create a database and configure the information in the .env file.
7. Run migrations to create database tables:

```
php artisan migrate

```

8. Start the server:

```
php artisan serve

```

## License

This project is licensed under the MIT License. See the [LICENSE](https://opensource.org/licenses/MIT) file for more information.
