<p align="center">
<img src="https://raw.githubusercontent.com/denisbertaglia/series-control/readme/public/img/logomark.svg" width="180" alt="Logo">
</p>

[Leia esta página em português :brazil: ](./README-pt.md)
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
git clone https://github.com/denisbertaglia/series-control.git
```

2. Install the project's php dependencies:

```
composer install
```

2. Install the project's php dependencies:

```
composer install
```

4. Create a .env file and configure environment variables:

```
cp .env.example .env
```

4. Generate the application key:

```
php artisan key:generate
```

5. Configure the connection just like sqlite in the .env file.

```
DB_CONNECTION=sqlite
```

6. Run migrations to create database tables:

```
php artisan migrate
```

7. Install the project's js dependencies:

```
npm install
```

8. Generate the assets for production

```
npm run build
```

9. Run tests:

```
php artisan test
```

10. Start the server:

```
php artisan serve
```

## License

This project is licensed under the MIT License. See the [LICENSE](https://opensource.org/licenses/MIT) file for more information.
