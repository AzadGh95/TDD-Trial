## How to create a test class?
```shell
php artisan make:test UserTest
```
If we want to create a unit test:
```shell
php artisan make:test UserTest --unit
```
How to clear config cache?
```shell
php artisan config:clear
```

How to install 'dusk' ?
```php
composer require --dev laravel/dusk
php artisan dusk:install
```

where is dusk's debug files?
```
tests/Browser/console/*.log
tests/Browser/screenshots/*.jpg
tests/Browser/sources/*.php
```
