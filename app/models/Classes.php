<?php


class Classes extends Eloquent
{
    protected $fillable = ['name', 'id_school', 'scollaryear', 'degree', 'domain', 'previous', 'visibility'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classes';


    public function getCourses()
    {
        return DB::table('courses')->where('id_class', '=', $this->id)->get();
    }

    public function getUsers()
    {
        $ids = DB::table('permissions')->where('id_class', '=', $this->id)->where('id_rights', '!=', 15)->lists('id_user');
        if (count($ids) != 0) {
            return User::whereIn('id', $ids)->get();
        } else {
            return array();
        }
    }

    public function getPermissionsTab($id_user)
    {
        $perm = DB::table('permissions')->where('id_user', '=', $id_user)->where('id_class', '=', $this->id)->first();

        $rep = array();
        if (!is_null($perm)) {
            $rep['read'] = ($perm->id_rights & 4) != 0;
            $rep['edit'] = ($perm->id_rights & 2) != 0;
            $rep['create'] = ($perm->id_rights & 1) != 0;
        } else {
            $rep['read'] = false;
            $rep['edit'] = false;
            $rep['create'] = false;
        }

        return $rep;
    }

    private function isAuthorized($permToTest)
    {
        $perms = $this->getPermissionsTab(Auth::id());
        return $perms[$permToTest];
    }

    public function canRead()
    {
        return $this->isAuthorized('read');
    }

    public function canEdit()
    {
        return $this->isAuthorized('edit');
    }

    public function canCreate()
    {
        return $this->isAuthorized('create');
    }

    public function isOwner($id_user)
    {
        $perm = DB::table('permissions')->where('id_user', '=', $id_user)->where('id_class', '=', $this->id)->first();

        if ($perm->id_rights == 15) {
            return true;
        }
        return false;

    }

    public function getSchool()
    {
        return Schools::find($this->id_school);
    }

    public function getSchoolName()
    {
        $school = Schools::find($this->id_school);
        return $school->name;
    }

    public function getCityName()
    {
        $city = Cities::find($this->getSchool()->id_location);
        return $city->name;
    }

    public function getCantonName()
    {
        $canton = $this->getSchool()->getCanton()->name;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function getSchollarYear()
    {
        return $this->attributes['scollaryear'];
    }

    public function getVisibilityStr()
    {
        if ($this->attributes['visibility'] == 1) {
            return 'Public';
        }
        return 'Private';
    }

    public function isPublic()
    {
        return $this->attributes['visibility'] == 1;
    }

    public function getOwner()
    {
        $premOwner = DB::table('permissions')->where('id_rights', '=', 15)->where('id_class', '=', $this->attributes['id'])->first();
        return User::find($premOwner->id_user);
    }

    public function isNotIn()
    {
        $perm = Permissions::where('id_user','=',Auth::id())->where('id_class','=',$this->attributes['id'])->get();

        if(count($perm) == 0)
        {
            return true;
        }
        else{
            return false;
        }
    }
}