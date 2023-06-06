## About This source code ...
Were developed many ways to test a project ...
- ## Database Testing
    Model factories, Relations, Database assertions and Refactoring Model tests.
- ## HTTP Tests
    Customizing Request Headers, Cookies, Routes, Views, Test with Ajax request, Validations, ResouceControllers, Middlewares, 
- ## Unit Test
    Testing an special action 

- ## Mocking
    Mocking Classes, Facades, Events
- ## Browser Test
    Provides an expressive, easy-to-use browser automation and testing Controllers

## How to run project?
```php
php artisan serve
npm install
npm run dev
```
## How to run Tests?
```
php artisan test
```
## How to run Browser Tests?
```
php artisan dusk
```
## How to create a test class?
```shell
php artisan make:test UserTest
```
### How to create Uint test?
```shell
php artisan make:test UserTest --unit
```
How to clear config cache?
```shell
php artisan config:clear
```

## How to install 'dusk' ?
```php
composer require --dev laravel/dusk
php artisan dusk:install
```

## Where is dusk's debug files?
```
tests/Browser/console/*.log
tests/Browser/screenshots/*.jpg
tests/Browser/sources/*.php
```


## Resources
  - [Laravel Document](https://laravel.com/docs)
  - [Mockery Document](http://docs.mockery.io)


-----------
If you can add something else to this project, please do it, I'm loking forward to share and extend this example project :)