<?php

class ClassController extends \BaseController
{

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
        $schoolList = DB::table('schools')->lists('name', 'id');
        array_unshift($schoolList, "------------");
        array_unshift($schoolList, "New School");
        $visibilityList = ['public' => 'public', 'private' => 'private'];

        $schollarYears = [];
        $currentYear = Date("Y") - 2;

        for ($i = 6; $i > 0; $i--) {
            array_unshift($schollarYears, ($currentYear + $i) . "-" . ($currentYear + $i + 1));
        }

        return View::make('classes.createclass')->with(array('schoolList' => $schoolList, 'visibilityList' => $visibilityList, 'schollarYears' => $schollarYears));
    }

    public function load()
    {
        //$input = Input::All();
        //Session::put('orderOption', $input['orderOption']);
        return View::make('classes/public');
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

        if ($input['school'] == 0) {
            return View::make('schools.school')->with(array('input' => $input));
        } else {
            $rulesValidatorUser = array('name' => 'required|min:3', 'scollaryear' => 'required', 'school' => 'required', 'degree' => 'required', 'domain' => 'required');
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
                return Redirect::to('/classes/create')->withErrors($validator)->withInput();
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    public function search($keyword)
    {
        //todo: get get only courses which are public/accessible?
        $classes = Classes::where('name', 'LIKE', $keyword)->get();
        return View::make('classes.searchdisplay')->with(array('classes' => $classes, 'keyword' => $keyword));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * Fct Modif Datas
     */

    public function inviteMember()
    {
        $input = Input::all();
        $user_invited = User::where('email', '=', $input['email'])->first();
        if ($user_invited == null) {
            $error = "No such user registered !";
            return Redirect::to('/classes/owned')->withErrors($error);
        } else if ($user_invited->id != Auth::id()) {
            if (Permissions::where('id_user', '=', $user_invited->id)->where('id_class', '=', $input['class'])->count() == 0) {
                $permission = new Permissions();
                $permission->id_user = $user_invited->id;
                $permission->id_class = $input['class'];
                $permission->id_rights = 2;
                $permission->save();

                return Redirect::to('/classes/owned');
            } else {
                Session::put('toast', array("error", "User already in the class."));
                return Redirect::to('/classes/owned');
            }
        } else {
            Session::put('toast', array("error", "Your are the owner ! Silly !"));
            return Redirect::to('/classes/owned');
        }
    }

    public function acceptMember($iduser, $idclass)
    {
        $class = Classes::find($idclass);

        if ($class->isOwner(Auth::id())) {
            $permission = Permissions::where('id_user', '=', $iduser)->where('id_class', '=', $idclass)->first();
            $permission->id_rights = 4;

            $permission->save();

            return Redirect::to('/classes/owned');
        } else {
            return Redirect::to('/unauthorized');
        }
    }

    public function refuseMember($iduser, $idclass)
    {
        $class = Classes::find($idclass);

        if ($class->isOwner(Auth::id())) {
            $permission = Permissions::where('id_user', '=', $iduser)->where('id_class', '=', $idclass)->first();
            $permission->delete();

            return Redirect::to('/classes/owned');
        } else {
            return Redirect::to('/unauthorized');
        }
    }

    public function removeCourse($idcourse)
    {
        $course = Courses::find($idcourse);
        $class = Classes::where('id', '=', $course->id_class)->first();

        if ($class->isOwner(Auth::id()) || $class->canCreate()) {
            $course->delete();
        }

        return Redirect::to('/classes/owned');
    }

    public function removeMember($iduser, $idclass)
    {
        $class = Classes::find($idclass);

        if ($class->isOwner(Auth::id())) {
            $permission = Permissions::where('id_user', '=', $iduser)->where('id_class', '=', $idclass)->first();
            $permission->delete();
        }

        return Redirect::to('/classes/owned');
    }

    public function chgt_rights($iduser, $idclass)
    {
        $class = Classes::find($idclass);

        if ($class->isOwner(Auth::id())) {
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

        return Redirect::to('/classes/owned');
    }

    public function chgtVisibility($idclass)
    {
        $class = Classes::find($idclass);
        if ($class->isOwner(Auth::id())) {
            $class = Classes::where('id', '=', $idclass)->first();

            if ($class->visibility == 'public') {
                $class->visibility = 'private';
            } else {
                $class->visibility = 'public';
            }
            $class->save();
        }

        return Redirect::to('/classes/owned');
    }

    public function removeClass($idclass)
    {
        $class = Classes::find($idclass);

        if ($class->isOwner(Auth::id())) {
            $class = Classes::find($idclass);
            $class->delete();
        }

        return Redirect::to('/classes/owned');
    }

    public function resignClass($idclass)
    {
        $permission = Permissions::where('id_class', '=', $idclass)->where('id_user', '=', Auth::id());
        $permission->delete();
        Session::put('toast', array("success", "Class resign success !"));
        return Redirect::to('/classes/participant');
    }

    public function open($idclass)
    {
        $info = DB::table('classes')->where('id', '=', $idclass)->get();
        $courses = DB::table('courses')->where('id_class', $idclass)->join('classes', 'classes.id', '=', 'courses.id_class')->orderBy('courses.name')->get();
        $school = DB::table('schools')->where('id', '=', $info[0]->id_school)->get();
        $city = DB::table('cities')->find($school[0]->id_location);
        $canton = DB::table('cantons')->find($city->id_canton);

        return View::make('classes.display')->with(array('class' => $info, 'courses' => $courses, 'school_name' => $school[0]->name, 'school_city' => $city->name, 'canton' => $canton->name));
    }

    public function selectedClass($idclass)
    {
        if (Auth::check()) {
            //$info = DB::table('classes')->where('id', '=', $idclass)->get();
            $info = Classes::find($idclass);
            if ($info->visibility == 'public' || (Auth::check() && $info->isOwner(Auth::id()))) {
                //Only for the classes's courses
                $courses = DB::table('courses')->where('id_class', $idclass)->orderBy('courses.name')->get();

                //Class informations
                $school = DB::table('schools')->where('id', '=', $info->id_school)->get();
                $city = DB::table('cities')->find($school[0]->id_location);
                $canton = DB::table('cantons')->find($city->id_canton);
                return View::make('courses.display')->with(array('class' => $info, 'courses' => $courses, 'school_name' => $school[0]->name, 'school_city' => $city->name, 'canton' => $canton->name, 'title' => $info->name));
            }
        }
        return Redirect::to('/unauthorized');
    }

    public function join($idclass)
    {
        $class = Classes::find($idclass);
        $permission = new Permissions();
        $permission->id_class = $idclass;
        $permission->id_user = Auth::id();

        if ($class->visibility == 'public') {
            $permission->id_rights = 4;
        } else {
            $permission->id_rights = 0;
        }

        $permission->save();

        Session::put('toast', array('success', 'Class successfully joinged !'));
        return Redirect::to('/classes/participant');
    }

    public function classOwned()
    {
        $classID = DB::table('permissions')->where('id_user', '=', Auth::id())->where('id_rights', '=', 15)->lists('id_class');

        if (!is_null($classID)) {
            if (count($classID) > 0) {
                $listClasses = DB::table('classes')->whereIn('id', $classID)->lists('name', 'id');

                $classesOwned = Classes::whereIn('id', $classID)->get();
                return View::make('users.gestionclassowner')->with(array('listClasses' => $listClasses, 'classesOwned' => $classesOwned));
            }
        }

        Session::put('toast', array('error', 'You own no class, try to create one.'));
        return Redirect::to('/classes/create');
    }

    public function getPublic($page)
    {
        $take = 12;
        $skip = ($page - 1) * $take;

        if (Auth::check()) {
            $listClass = DB::table('permissions')->where('id_user', '=', Auth::id())->lists('id_class');
            $classes_public = Classes::where('visibility', '=', 'public')->whereNotIn('id', $listClass)->skip($skip)->take($take)->get();
            $numberOfPages = Classes::where('visibility', '=', 'public')->whereNotIn('id', $listClass)->count();
        } else {
            $classes_public = Classes::where('visibility', '=', 'public')->skip($skip)->take($take)->get();
            $numberOfPages = Classes::where('visibility', '=', 'public')->skip($skip)->take($take)->count();
        }
        $numberOfPages = ceil($numberOfPages / $take);
        return View::make('classes.public')->with(array('classes' => $classes_public, 'numberOfPages' => $numberOfPages, 'pageNo' => $page, 'title' => 'Public Classes'));
    }

    public function classParticipant($page)
    {
        $take = 12;
        $skip = ($page - 1) * $take;
        $listClass = DB::table('permissions')->where('id_user', '=', Auth::id())->lists('id_class');
        $classes_public = Classes::whereIn('id', $listClass)->skip($skip)->take($take)->get();
        $numberOfPages = Classes::whereIn('id', $listClass)->count();
        $numberOfPages = ceil($numberOfPages / $take);
        return View::make('classes.userdisplay')->with(array('classes_public' => $classes_public, 'numberOfPages' => $numberOfPages, 'pageNo' => $page));
    }
}

















