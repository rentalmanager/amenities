<?php
namespace RentalManager\Amenities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use RentalManager\Amenities\Traits\AmenitiesAmenityTrait;

/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 2:12 PM
 * AmenitiesAmenity.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

class AmenitiesAmenity extends Model
{

    use AmenitiesAmenityTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;


    /**
     * Model constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('amenities.tables.amenities');
    }
}