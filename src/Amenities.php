<?php
namespace RentalManager\Amenities;

/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 2:10 PM
 * Amenities.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

class Amenities
{
    /**
     * Laravel application.
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;


    /**
     * Base constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }
}