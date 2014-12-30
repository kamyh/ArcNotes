<?php

class ClassController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     *
     *
     */
    public function createClass()
    {
        $schoolList = DB::table('schools')->lists('name','id');
        array_unshift($schoolList, "------------");
        array_unshift($schoolList, "New School");
        $visibilityList =['public' => 'public','private' => 'private'];

        $schollarYears = [];
        $currentYear = Date("Y")-2;

        for($i = 6;$i>0;$i--)
        {
            array_unshift($schollarYears, ($currentYear + $i)."-".($currentYear +$i+1));
        }

        return View::make('createclass')->with(array('schoolList'=>$schoolList,'visibilityList'=>$visibilityList,'schollarYears'=>$schollarYears));
    }

    public function load()
    {
        //$input = Input::All();
        //Session::put('orderOption', $input['orderOption']);
        return View::make('class/public');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     * @param ['name','id_school','scollaryear','degree','domain','previous','visibility']
     */
    public function store()
    {
        $input = Input::all();

        if($input['school'] == 0)
        {
            return View::make('/school')->with(array('input'=>$input));
        }
        else {

            $rulesValidatorUser = array('name' => 'required|min:5', 'scollaryear' => 'required', 'school' => 'required', 'degree' => 'required', 'domain' => 'required');

            $validator = Validator::make($input, $rulesValidatorUser);

            if (!$validator->fails()) {

                $class = new Classes();

                $class->name = $input['name'];
                $class->scollaryear = $input['scollaryear'];
                $class->id_school = $input['school'];
                $class->degree = $input['degree'];
                $class->domain = $input['domain'];
                $class->visibility = $input['visibility'];
                $class->save();

                $permission = new Permissions();

                $permission->id_user = Auth::id();
                $permission->id_rights = 15;
                $permission->id_class = $class->id;
                $permission->save();

                return Redirect::to('/');

            } else {
                return Redirect::to('/class/create')->withErrors($validator)->withInput();
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * Fct Modif Datas
     */

    public function invite_member()
    {
        $input = Input::all();

        $user_invited = User::where('email','=',$input['email'])->first();

        if($user_invited == null)
        {
            $error = "No such user registered !";
            return Redirect::to('manager/classowned')->withErrors($error)->withInput();
        }
        else
        {
            $permission = new Permissions();
            $permission->id_user = $user_invited->id;
            $permission->id_class = $input['class'];
            $permission->id_rights = 1;

            $permission->save();

            return Redirect::to('manager/classowned');
        }
    }

    public function accept_member($iduser,$idclass)
    {
        $class = Classes::find($idclass);

        if($class->isOwner(Auth::id()))
        {
            $permission = Permissions::where('id_user', '=', $iduser)->where('id_class', '=', $idclass)->first();
            $permission->id_rights = 4;

            $permission->save();

            return Redirect::to('manager/classowned');
        }
        else
        {
            return Redirect::to('unauthorized');
        }
    }

    public function refuse_member($iduser,$idclass)
    {
        $class = Classes::find($idclass);

        if($class->isOwner(Auth::id()))
        {
            $permission = Permissions::where('id_user','=',$iduser)->where('id_class','=',$idclass)->first();
            $permission->delete();

            return Redirect::to('manager/classowned');
        }
        else
        {
            return Redirect::to('unauthorized');
        }
    }

    public function remove_course($idcourse)
    {
        $course = Courses::find($idcourse);
        $class = Classes::where('id', '=', $course->id_class)->first();

        if($class->isOwner(Auth::id()) || $class->canCreate())
        {
            $course->delete();
        }

        return Redirect::to('manager/classowned');
    }

    public function remove_member($iduser,$idclass)
    {
        $class = Classes::find($idclass);

        if($class->isOwner(Auth::id())) {
            $permission = Permissions::where('id_user', '=', $iduser)->where('id_class', '=', $idclass)->first();

            $permission->delete();
        }

        return Redirect::to('manager/classowned');
    }

    public function chgt_rights($iduser,$idclass)
    {
        $class = Classes::find($idclass);

        if($class->isOwner(Auth::id())) {
            $input = Input::all();

            $rights = 0;

            if (isset($input['read'])) {
                $rights += 4;
            }
            if (isset($input['edition'])) {
                $rights += 2;
            }
            if (isset($input['creation'])) {
                $rights += 1;
            }

            $permission = Permissions::where('id_user', '=', $iduser)->where('id_class', '=', $idclass)->first();
            $permission->id_rights = $rights;

            $permission->save();
        }

        return Redirect::to('/manager/classowned');
    }

    public function chgt_visibility($idclass)
    {
        $class = Classes::find($idclass);

        if($class->isOwner(Auth::id())) {
            $class = Classes::where('id', '=', $idclass)->first();

            if ($class->visibility == 'public') {
                $class->visibility = 'private';
            } else {
                $class->visibility = 'public';
            }

            $class->save();
        }

        return Redirect::to('manager/classowned');
    }

    public function remove_class($idclass)
    {
        $class = Classes::find($idclass);

        if($class->isOwner(Auth::id())) {
            $class = Classes::where('id', '=', $idclass)->first();

            $class->delete();
        }

        return Redirect::to('manager/classowned');
    }

    public function resign_class($idclass)
    {
        $permission = Permissions::where('id_class','=',$idclass)->where('id_user','=', Auth::id());

        $permission->delete();

        return Redirect::to('/');
    }

    public function open($idclass)
    {
        $info = DB::table('classes')->where('id','=',$idclass)->get();

        $courses = DB::table('courses')->where('id_class',$idclass)->join('classes', 'classes.id', '=', 'courses.id_class')->orderBy('courses.name')->get();

        $school = DB::table('schools')->where('id','=',$info[0]->id_school)->get();
        $city = DB::table('cities')->find($school[0]->id_location);

        $canton = DB::table('cantons')->find($city->id_canton);

        return View::make('class.display')->with(array('class' => $info,'courses'=>$courses,'school_name'=>$school[0]->name,'school_city'=>$city->name,'canton'=>$canton->name));
    }

    public function selectedClass($idclass)
    {
        if(Auth::check())
        {
            //$info = DB::table('classes')->where('id', '=', $idclass)->get();
            $info = Classes::find($idclass);
            if($info->visibility == 'public' || (Auth::check() && $info->isOwner(Auth::id())))
            {
                //Only for the classes's courses
                $courses = DB::table('courses')->where('id_class', $idclass)->orderBy('courses.name')->get();

                //Class informations

                $school = DB::table('schools')->where('id', '=', $info->id_school)->get();
                $city = DB::table('cities')->find($school[0]->id_location);
                $canton = DB::table('cantons')->find($city->id_canton);


                return View::make('course.display')->with(array('class' => $info, 'courses' => $courses, 'school_name' => $school[0]->name, 'school_city' => $city->name, 'canton' => $canton->name, 'title' => $info->name));
            }
            else
            {
                return Redirect::to('unauthorized');
            }
        }
        else
        {
            return Redirect::to('unauthorized');
        }
    }

    public function join($idclass)
    {
        $class = Classes::find($idclass);

        $permission = new Permissions();
        $permission->id_class = $idclass;
        $permission->id_user = Auth::id();

        if($class->visibility == 'public')
        {
            $permission->id_rights = 4;
        }
        else {
            $permission->id_rights = 0;
        }

        $permission->save();

        return Redirect::to('/class/join');
    }

    public function class_owned()
    {
        $classID = DB::table('permissions')->where('id_user','=',Auth::id())->where('id_rights','=',15)->lists('id_class');

        if(!is_null($classID)) {
            if (count($classID) > 0) {
                $listClasses = DB::table('classes')->whereIn('id', $classID)->lists('name', 'id');

                $classesOwned = Classes::whereIn('id', $classID)->get();
                return View::make('users/gestionclassowner')->with(array('listClasses' => $listClasses, 'classesOwned' => $classesOwned));

            }
        }

        return Redirect::to('/class/create');
    }

    public function getpublic($page)
    {
        $take = 12;
        $skip = ($page -1) * $take;


        if(Auth::check())
        {
            $listClass = DB::table('permissions')->where('id_user', '=', Auth::id())->lists('id_class');
            $classes_public = Classes::where('visibility', '=', 'public')->whereNotIn('id',$listClass)->skip($skip)->take($take)->get();
            $numberOfPages = Classes::where('visibility', '=', 'public')->whereNotIn('id',$listClass)->count();

        }
        else
        {
            $classes_public = Classes::where('visibility', '=', 'public')->skip($skip)->take($take)->get();
            $numberOfPages = Classes::where('visibility', '=', 'public')->skip($skip)->take($take)->count();
        }

        $numberOfPages = ceil($numberOfPages/$take);
        return View::make('class.public')->with(array('classes'=>$classes_public,'numberOfPages'=>$numberOfPages,'pageNo'=>$page,'title'=>'Public Classes'));
    }

    public function classParticipant($page)
    {
            $take = 12;

            $skip = ($page - 1) * $take;

            $listClass = DB::table('permissions')->where('id_user', '=', Auth::id())->lists('id_class');
            $classes_public = Classes::whereIn('id', $listClass)->skip($skip)->take($take)->get();
            $numberOfPages = Classes::whereIn('id', $listClass)->count();

            $numberOfPages = ceil($numberOfPages / $take);
            return View::make('class.userdisplay')->with(array('classes_public' => $classes_public, 'numberOfPages' => $numberOfPages, 'pageNo' => $page));

    }
}

















