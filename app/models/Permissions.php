<?php



class Permissions extends Eloquent
{
    protected $fillable = ['id_user','id_rights','id_class'];

    public function getRights()
    {
        return $this->attributes['id_rights'];
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';
}
