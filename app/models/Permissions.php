<?php



class Permissions extends Eloquent
{
    protected $fillable = ['id_user','id_rights','id_class'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';
}
