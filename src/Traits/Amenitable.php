<?php
namespace RentalManager\Amenities\Traits;

/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 2:22 PM
 * AmenityPropertyTrait.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

trait Amenitable
{

    /**
     * Scope where amenities are
     *
     * @param $query
     * @param array $amenities
     * @return mixed
     */
    public function scopeWhereAmenitiesAre($query, $amenities = [])
    {
        return $query->whereHas('amenities', function($amenityQuery) use ( $amenities ) {
            $amenityQuery->whereIn('id', $amenities);
        });
    }


    /**
     * Attach a single amenity
     *
     * @param $amenity
     * @return $this
     */
    public function attachAmenity($amenity)
    {
        return $this->attachAmenitableModel('amenities', $amenity);
    }

    /**
     * Detach a single amenity
     *
     * @param $amenity
     * @return static
     */
    public function detachAmenity( $amenity )
    {
        return $this->detachAmenitableModel('amenities', $amenity);
    }

    /**
     * Attach multi amenities
     *
     * @param array $amenities
     * @return $this
     */
    public function attachAmenities( $amenities = [])
    {

        foreach ( $amenities as $amenity )
        {
            $this->attachAmenity($amenity);
        }


        return $this;
    }

    /**
     * Detach the amenities
     *
     * @param array $amenities
     * @return $this
     */
    public function detachAmenities( $amenities = [])
    {
        if (empty( $amenities ) ) {
            $amenities = $this->amenities()->get();
        }

        foreach ( $amenities as $amenity )
        {
            $this->detachAmenity($amenity);
        }
        return $this;
    }

    /**
     * Sync amenities
     *
     * @param $amenities
     * @param bool $detaching
     * @return $this
     */
    public function syncAmenities($amenities = [], $detaching = true)
    {
        return $this->syncAmenitableModels('amenities', $amenities, $detaching);
    }

    /**
     * Sync amenities without detaching
     *
     * @param $amenities
     * @return $this
     */
    public function syncAmenitiesWithoutDetaching($amenities = [])
    {
        return $this->syncAmenities($amenities, false);
    }

    /**
     * Amenities relationship polymorphic
     *
     * @return mixed
     */
    public function amenities()
    {
        return $this->morphToMany(
            'App\RentalManager\AddOns\Amenity', // model
            'node', // node
            'amenity_node', // table
            'node_id',
            'amenity_id'
        );
    }

    // ALIASES
    // ---------------------------

    /**
     * Alias to eloquent attach() method
     *
     * @param $relationship
     * @param $object
     * @return $this
     */
    private function attachAmenitableModel($relationship, $object)
    {
        $attributes = [];
        $this->$relationship()->attach(
            $object,
            $attributes
        );

        return $this;
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method
     *
     * @param string $relationship
     * @param mixed $object
     * @return static
     */
    private function detachAmenitableModel($relationship, $object)
    {
        $relationshipQuery = $this->$relationship();
        $relationshipQuery->detach($object);

        return $this;
    }

    /**
     * Alias to eloquent sync() method
     *
     * @param $relationship
     * @param $objects
     * @param bool $detaching
     * @return $this
     */
    public function syncAmenitableModels($relationship, $objects, $detaching = true)
    {
        $relationshipToSync = $this->$relationship();

        $result = $relationshipToSync->sync($objects, $detaching);

        return $this;
    }
}
