<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
    protected $fillable = ['firstname','lastname','email','password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');



    public static function getUserRights($idclass)
    {
        return DB::table('permissions')->where('id','=',Auth::id())->where('id_class','=',$idclass)->get();
	}

    public function getClasses()
    {
        $ids = DB::table('permissions')->where('id_user','=',Auth::id())->where('id_rights','>',0)->lists('id_class');

        if(!is_null($ids))
        {
            if(count($ids) > 0)
                return Classes::whereIn('id', $ids)->get();
        }
        return array();
    }

    public function getUserPermForClass($id_class)
    {
        return DB::table('permissions')->where('id_user','=',$this->id)->where('id_class','=',$id_class)->first()->id_rights;
    }

    public function getSignature()
    {
        return $this->attributes['firstname'] .' '. $this->attributes['lastname'];
    }

}
