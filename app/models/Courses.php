<?php



class Courses extends Eloquent
{
    protected $fillable = ['name'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';


    public function getClassID()
    {
        return $this->attributes['id_class'];
    }

    public function getName()
    {
        return $this->attributes['name'];
    }



}
