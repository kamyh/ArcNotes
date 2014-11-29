<?php



class Classes extends Eloquent
{
    protected $fillable = ['name','id_school','scollaryear','degree','domain','previous','visibility'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classes';


    public function getCourses()
    {
        return DB::table('courses')->where('id_class','=',$this->id)->get();
    }

    public function getUsers()
    {
        $ids = DB::table('permissions')->where('id_class','=',$this->id)->where('id_rights','!=',15)->lists('id_user');
        return User::whereIn('id',$ids)->get();
    }

    public function getPermissionsTab($id_user)
    {
        $perm = DB::table('permissions')->where('id_user','=',$id_user)->where('id_class','=',$this->id)->first();

        $isCheckRead = 0;
        $isCheckEdition = 0;
        $isCheckCreation = 0;

        if(($perm->id_rights & 4) != 0)
        {
            $isCheckRead = true;
        }
        if(($perm->id_rights & 2) != 0)
        {
            $isCheckEdition = true;
        }
        if(($perm->id_rights & 1) != 0)
        {
            $isCheckCreation = true;
        }

        $rep = [];
        array_push($rep,$isCheckRead);
        array_push($rep,$isCheckEdition);
        array_push($rep,$isCheckCreation);

        return $rep;
    }
}

