<?php
/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 2:03 PM
 * amenities.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | These are the models to define the tables
    | If you want the models to be in a different namespace or
    | to have a different name, you can do it here.
    |
    */
    'models' => [
        /**
         * Amenities model
         */
        'amenity' => 'App\RentalManager\AddOns\Amenity'
    ],

    /*
  |--------------------------------------------------------------------------
  | Tables
  |--------------------------------------------------------------------------
  |
  | These are the tables to store all the necessary data.
  |
  */
    'tables' => [
        /**
         * Amenities table
         */
        'amenities' => 'amenities',
        /**
         * Intermediate table
         */
        'amenity_nodes' => 'amenity_nodes'
    ],

    /*
   |--------------------------------------------------------------------------
   | Foreign Keys
   |--------------------------------------------------------------------------
   |
   | These are the foreign keys used by propeller in the intermediate tables.
   |
   */
    'foreign_keys' => [
        /**
         * Amenity foreign key
         */
        'amenity' => 'amenity_id'
    ],
];