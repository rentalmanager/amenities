<?php
namespace RentalManager\Amenities\Traits;


/**
 * Trait AmenitiesAmenityTrait
 * @package RentalManager\Amenities\Traits
 */
trait RMAmenityTrait
{
    /**
     * Always set as the json encoded string
     *
     * @param $value
     */
    public function setStandardizationAttribute($value)
    {
        $this->attributes['standardization'] = ( $value ) ? json_encode($value) : null;
    }

    /**
     * Get the standardization column as json decoded array
     *
     * @param $value
     * @return mixed|null
     */
    public function getStandardizationAttribute($value)
    {
        return ( $value ) ? json_decode( $value, true ) : null;
    }


    /**
     * Return amenities by group name
     *
     * @param $group
     * @return mixed
     */
    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    /**
     * Return amenities by type name
     *
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Return the all available groups (distinct)
     *
     * @param $query
     * @return mixed
     */
    public function scopeGroups($query)
    {
        return $query->select('group')->distinct();
    }

    /**
     * Return the all available types (distinct)
     *
     * @param $query
     * @return mixed
     */
    public function scopeTypes($query)
    {
        return $query->select('type')->distinct();
    }


    /**
     * Return the associated properties for this amenity
     *
     * @return mixed
     */
    public function associatedProperties()
    {
        return $this->getMorphByRelation('App\RentalManager\Main\Property');
    }


    /**
     * Return the associated units for this amenity
     *
     * @return mixed
     */
    public function associatedUnits()
    {
        return $this->getMorphByRelation('App\RentalManager\Main\Unit');
    }

    /**
     * Morphed by many
     * @param $relationship
     * @return mixed
     */
    public function getMorphByRelation($relationship)
    {
        return $this->morphedByMany(
            $relationship,
            'node',
            'amenity_node',
            'amenity_id',
            'node_id'
        );
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (!preg_match('/^can[A-Z].*/', $method)) {
            return parent::__call($method, $parameters);
        }
    }
}
