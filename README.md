# Test task for Akticom

## Production

This test project is deployed on Heroku and is available at the following address:
```
https://test-akticom-23efd9c74145.herokuapp.com/
```

## Getting started

These instructions will give you a copy of the project up and running on your local machine for development and testing purposes.

## Installation

A step by step series of examples that tell you how to get a development environment running

1. Clone this repo

```
git clone https://github.com/Ermahan-Nurgazy/test-akticom.git
```

2. Install composer dependencies

```
composer install
```
3. Copy environment file (.env.example)

```
cp .env.example .env
```
4. Generate app key

```
php artisan key:generate
```
5. Running migrations

```
php artisan migrate
```

## Postman documentation

Use this Postman collection to interact with the API endpoints

- [Link to collection](https://documenter.getpostman.com/view/19202302/2sA3JM82K2)

## Testing

Steps for testing the basic functionality

1. Copy environment file for testing (.env.testing)

```
cp .env.testing .env
```

2. Running migrations

```
php artisan migrate
```

3. Running tests

```
vendor/bin/phpunit
```

## Code style

Steps to maintain a uniform code style. Since the uniform code style is described in the "pint.json", you just need to use the following commands:

* To apply changes according to the same code style:

```
vendor/bin/pint
```

* To view recommended changes to maintain a consistent code style:

```
vendor/bin/pint --test -v
```
