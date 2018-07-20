# RentalManager - AMENITIES

A package made for Rentbits for easier maintenance and modularity of managing rental listings. 
It includes all migrations, models and relations to run the rental system.

## Installation, Configuration and Usage

### Installation

Via Composer

Since this package needs to be private, first you need to add the following line to the composer.json file:

``` json
"repositories": [
        {
            "type": "git",
            "url": "git@gitlab.com:rentalmanager/amenities.git"
        }
    ]
```

You must be approved by admin into the Gitlab account so your public key needs to have an access to the above repo.

After that just simply add the following line to the composer required packages

``` json
"rentalmanager/amenities": "1.1.*"
```

After that run the 

``` bash
$ composer update
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

We assume you have already installed the Base package, so then just add traits automagically

```bash
$ php artisan rm:add-amenitable-trait
```

Thats it...

### Seed

This package provides some of the default data. You must seed them to your database.

You can publish seeder with the following command (it's actually separate function from the setup):

``` bash
$ php artisan rm:seeder-amenities
```

The above command will create the propeller seeder class.

After you publish the seeder make sure you dump autoload of the composer cache, how your newly seeder class will be discovered.

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
