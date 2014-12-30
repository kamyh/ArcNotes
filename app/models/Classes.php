<?php



class Classes extends Eloquent
{
    protected $fillable = ['name','id_school','scollaryear','degree','domain','previous','visibility'];
    private $school;
    private $id_location;
    private $city;
    private $id_canton;

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
        if(count($ids) != 0)
        {
            return User::whereIn('id', $ids)->get();
        }
        else
        {
            return array();
        }
    }

    public function getPermissionsTab($id_user)
    {
        $perm = DB::table('permissions')->where('id_user','=',$id_user)->where('id_class','=',$this->id)->first();

        $rep = array();
        if(!is_null($perm))
        {
            $rep['read'] = ($perm->id_rights & 4) != 0;
            $rep['edit'] = ($perm->id_rights & 2) != 0;
            $rep['create'] = ($perm->id_rights & 1) != 0;
        }
        else
        {
            $rep['read'] = false;
            $rep['edit'] = false;
            $rep['create'] = false;
        }

        return $rep;
    }

    private function isAuthorized($permToTest)
    {
        $perms = getPermissionsTab(Auth::id());
        return $perms[$permToTest];
    }

    public function canRead()
    {
        return isAuthorized('read');
    }

    public function canEdit()
    {
        return isAuthorized('edit');
    }

    public function canCreate()
    {
        return isAuthorized('create');
    }

    public function isOwner($id_user)
    {
        $perm = DB::table('permissions')->where('id_user','=',$id_user)->where('id_class','=',$this->id)->first();

        if($perm->id_rights == 15)
        {
            return true;
        }
        return false;
    }

    public function getSchoolName()
    {
        $this->school = School::find($this->id_school);
        $this->id_location = $this->school->id_location;
        return $this->school->name;
    }

    public function getCitie()
    {
        $this->city = Cities::find($this->id_location);
        $this->id_canton = $this->city->id_canton;
        return $this->city->name;
    }

    public function getCanton()
    {
        return DB::table('cantons')->find($this->id_canton)->name;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function getSchollarName()
    {
        return $this->attributes['scollaryear'];
    }
}

