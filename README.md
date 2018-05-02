# Work with module banner

**1.**
```php
//write to composer.json
"require": {
    ...
    "softce/banner" : "dev-master"
}

"autoload": {
    ... ,

    "psr-4": {
        ... ,

        "Softce\\Banner\\" : "vendor/softce/banner/src"
    }
}
```


**2.**
```php
//in console write

composer update softce/banner
```


**3.**
```php
//in service provider config/app

'providers' => [
    ... ,
    Softce\Banner\Providers\BannerServiceProvider::class,
]


// in console 
php artisan config:cache
```

**4.**
```php
//To work with slides, start the migration

php artisan migrate

```


**5.**
```php
//for show page slider, in code add next row

{{ route('admin.banner.index') }}

```

# For delete module

```php
//delete next row

1.
//in app.php
Softce\Banner\Providers\BannerServiceProvider::class,

2.
//in composer.json
"Softce\\Banner\\": "vendor/softce/banner/src"

3.
//in console
composer remove softce/banner

4.
// delete -> bootstrap/config/cache.php

5.
//in console
php artisan config:cache

6.
//delete table -> banners

7.
//delete migration -> 2018_04_26_113110_create_banner_table

8.
//delete row in admin_menus table -> where name 'Банер'
```

