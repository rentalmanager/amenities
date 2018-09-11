# RentalManager - AMENITIES

A package made for Rentbits for easier maintenance and modularity of managing rental listings. 
It includes all migrations, models and relations to run the rental system.

## Installation, Configuration and Usage

### Installation

Via Composer

```bash
composer require rentalmanager/amenities
```

### Configuration

Once you install the package, it should be automatically discovered by the Laravel. To check this, in your terminal simply run the:


``` bash
$ php artisan
```

There you should find the all `rm:*` commands.

First step after checking is to publish the vendors:

``` bash
$ php artisan vendor:publish --tag="amenities"
```

After that it depends on you. If you are a hard learner, run through each commands manually, but then
you can just simply run the

``` bash
$ php artisan rm:setup-amenities
```

Thats it...

``` bash
$ composer dump-autoload
```

You can add seeder class to your DB seeder like:

``` php
$this->call(RentalManagerAmenitiesSeeder::class);
```

Or by running the seeder directly by invoking:

``` bash
$ php artisan db:seed --class=RentalManagerAmenitiesSeeder 
```

## Usage

Below is the sample usages of this package:

To attach the single amenity to a unit or a property (the same applies)

```php 
$object->attachAmenity(1);
```

To attach multiple amenities

```php
$object->attachAmenities([1,2,3]);
```

There is common sync methods as well
```php
$object->syncAmenities([1,2,3]);
```

and without detaching

```php
$object->syncAmenitiesWithoutDetaching([1,2,3]);
```

### Scopes

This package provides a usable scope for amenitable objects

```php
// get all objects where amenities are
$result = $object->whereAmenitiesAre([1,2,3]);
```

And few scopes for the amenity model itself

```php
$amenities = Amenity::byGroup('notable');

$amenities = Amenity::byType('unit');

// disctinct by groups
$groups = Amenity::groups();

$types = Amenity::types();
```
