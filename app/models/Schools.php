<?php


class Schools extends Eloquent
{
    protected $fillable = ['name'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schools';


    public function getCanton()
    {
        $city = Cities::find($this->id_location);
        $canton = Canton::find($city->id_canton);
        return $canton;
    }

    public function getCity()
    {
        return Cities::find($this->id_location);
    }

    public function getLocation()
    {
        $city = $this->getCity();
        $canton = $this->getCanton();

        return $city->zipcode . ' ' . $city->name . ' ' . $canton->name;
    }
}
