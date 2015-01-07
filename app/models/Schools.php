<?php


class School extends Eloquent
{
    protected $fillable = ['name'];

    private $id_location;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schools';


    public function getLocation()
    {
        $city = Cities::find($this->id_location);
        $canton = Canton::find($city->id_canton);

        return $city->zipcode . ' ' . $city->name . ' ' . $canton->name;
    }
}
