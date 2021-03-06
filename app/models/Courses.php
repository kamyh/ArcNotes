<?php



class Courses extends Eloquent
{
    protected $fillable = ['name','matter'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

    private $id;


    public function getClassID()
    {
        return $this->attributes['id_class'];
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function getParentClass()
    {
        return Classes::find($this->getClassID());
    }

    public function getID()
    {
        return $this->attributes['id'];
    }
}
