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
     * Display the creation class form
     *
     */
    public function createClass()
    {
        $query = "SELECT schools.id AS id_school, schools.name, cities.name AS city, cantons.name AS canton FROM schools INNER JOIN cities ON cities.id = schools.id_location INNER JOIN cantons ON cantons.id = cities.id_canton ORDER BY schools.name";
        $schoolList = DB::select($query);//->get()->lists('schoools.name', 'schools.id');

        $formatted_schoolList = array();
        if (count($schoolList) > 0) {
            foreach ($schoolList as $infos_school) {
                if (!is_null($infos_school)) {
                    $formatted_schoolList[(string)$infos_school->id_school] = $infos_school->name . ', ' . $infos_school->city . ' ' . $infos_school->canton;
                }
            }
        }

        //return var_dump($formatted_schoolList);
        $array_default = array();
        $array_default[-1] = "New School";
        $array_default[0] = "------------";
        $final_schoollist = $array_default+$formatted_schoolList;

        $visibilityList = [1 => 'public', 0 => 'private'];
        $schollarYears = [];
        $from = Date("Y") - 2;
        $to = Date("Y") + 6;
        for ($i = $from; $i < $to; $i++) {
            $schollarYears[($i . "-" . ($i + 1))] = (($i . "-" . ($i + 1)));
        }

        return View::make('classes.createclass')->with(array('schoolList' => $final_schoollist, 'visibilityList' => $visibilityList, 'schollarYears' => $schollarYears));
    }

    public function load()
    {
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
        if ($input['school'] < 0) {
            return View::make('schools.school')->with(array('input' => $input));
        } else {
            $rulesValidatorUser = array('name' => array('required', 'min:3', 'regex:/^[a-zA-Z0-9-_àéèöïçîêôâ ]+$/'), 'scollaryear' => array('required', 'regex:/^\d{4}-\d{4}$/'), 'school' => 'required', 'degree' => 'required|AlphaNum', 'domain' => 'required|AlphaNum');
            $validator = Validator::make($input, $rulesValidatorUser);
            if (!$validator->fails()) {
                $id_school = (int)$input['school'];
                $unique_class = Classes::where('name', '=', $input['name'])->where('id_school', '=', $id_school)->where('scollaryear', '=', $input['scollaryear'])->first();
                if (is_null($unique_class)) {
                    $school = Schools::find($id_school);
                    if (!is_null($school)) {
                        $class = new Classes();
                        $class->name = $input['name'];
                        $class->scollaryear = $input['scollaryear'];
                        $class->id_school = $id_school;
                        $class->degree = $input['degree'];
                        $class->domain = $input['domain'];
                        $class->visibility = (int)$input['visibility'];
                        $class->save();
                        $permission = new Permissions();
                        $permission->id_user = Auth::id();
                        $permission->id_rights = 15; // 15 = owner
                        $permission->id_class = $class->id;
                        $permission->save();
                        Session::put('toast', array('success', "Class " . $class->getName() . " sucessfully added !"));
                        return Redirect::to('/classes/owned');
                    } else {
                        Session::put('toast', array('error', "This school does not exist ! Impossible to create class."));
                        return Redirect::to('/classes/create')->withInput();
                    }
                } else {
                    Session::put('toast', array('error', "Class " . $unique_class->getName() . " already exist in this school for " . e($input['scollaryear']).'.'));
                    return Redirect::to('/classes/create')->withInput();
                }

            } else {
                return Redirect::to('/classes/create/')->withErrors($validator)->withInput();
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

    /**
     * @param $keyword
     * @return mixed
     */
    public function search($keyword)
    {
        //todo: get get only classes which are public/accessible?
        $classes = Classes::where('name', 'LIKE', "%" . $keyword . "%")->where("visibility", '=', "1")->get();
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

    /**
     * Handle the invitation of a a new member in a class
     * @return mixed
     */
    public function inviteMember()
    {
        $input = Input::all();
        $user_invited = User::where('email', '=', $input['email'])->first();
        $class = Classes::find($input['class']);
        if ($user_invited == null) {
            $errors = "No such user registered !";
            Session::put('toast', array('error', $errors));
            Session::put('errorOrigine', $input['class']);
            return Redirect::to('/classes/owned')->withErrors($errors);
        } else if ($user_invited->id != Auth::id()) {
            if (Permissions::where('id_user', '=', $user_invited->id)->where('id_class', '=', $input['class'])->count() == 0) {
                if (!is_null($class)) {
                    $permission = new Permissions();
                    $permission->id_user = $user_invited->id;
                    $permission->id_class = $input['class'];
                    $permission->id_rights = 1;
                    $permission->save();
                    Session::put('toast', array('success', 'User ' . $user_invited->getSignature() . ' has been invited into ' . $class->getName() . '.'));
                    return Redirect::to('/classes/owned');
                } else {
                    $errors = "Cannot invite user in an inexistant class !";
                    Session::put('toast', array('error', $errors));
                    return Redirect::to('/classes/owned')->withErrors($errors);
                }
            } else {
                Session::put('toast', array('error', 'User ' . $user_invited->getSignature() . ' is already member of ' . $class->getName() . '.'));
                return Redirect::to('/classes/owned');
            }
        } else {
            Session::put('toast', array('error', "You actually are the owner, silly !"));
            return Redirect::to('/classes/owned');
        }
    }

    /**
     * Handle the admitence of a class member
     *
     * @param $iduser
     * @param $idclass
     * @return mixed
     */
    public function acceptMember($iduser, $idclass)
    {
        $class = Classes::find($idclass);

        if ($class->isOwner(Auth::id())) {
            $permission = Permissions::where('id_user', '=', $iduser)->where('id_class', '=', $idclass)->first();
            $permission->id_rights = 4;
            $permission->save();
            $user = User::find($iduser);
            if (!is_null($user)) {
                Session::put('toast', array('success', 'User ' . $user->getSignature() . ' accepted in class ' . $class->getName() . '.'));

                Mail::send('emails.accept', array('class' => $class), function ($message) use ($user) {
                    $message->to($user->email, $user->firstname + " " + $user->lastname)
                        ->subject('New member')->from('arcnotesnoreply@gmail.com');
                });
            }

            return Redirect::to('/classes/owned');
        } else {
            return Redirect::to('/unauthorized');
        }
    }

    /**
     * Handle the refue of a member
     *
     * @param $iduser
     * @param $idclass
     * @return mixed
     */
    public function refuseMember($iduser, $idclass)
    {
        $class = Classes::find($idclass);
        if ($class->isOwner(Auth::id())) {
            $permission = Permissions::where('id_user', '=', $iduser)->where('id_class', '=', $idclass)->first();
            $permission->delete();
            $user = User::find($iduser);
            if (!is_null($user)) {
                Session::put('toast', array('success', 'User ' . $user->getSignature() . ' refused to join class ' . $class->getName() . '.'));
            }
            return Redirect::to('/classes/owned');
        } else {
            return Redirect::to('/unauthorized');
        }
    }

    /**
     * Delete a course from a class
     *
     * @param $idcourse
     * @return mixed
     */
    public function removeCourse($idcourse)
    {
        $course = Courses::find($idcourse);
        if (!is_null($course)) {
            $class = Classes::find($course->id_class);
            if (!is_null($class)) {
                if ($class->isOwner(Auth::id()) || $class->canCreate()) {
                    $course->delete();
                    Session::put('toast', array('success', "Course " . $course->getName() . "has been removed from class " . $class->getName() . "."));
                } else {
                    Session::put('toast', array('error', "Course " . $course->getName() . "You actually can't remove this course from the class " . $class->getName() . "."));
                }
            } else {
                Session::put('toast', array('error', "Class " . $class->getName() . " does not exist."));
            }
        } else {
            Session::put('toast', array('error', "No such course found."));
        }
        return Redirect::to('/classes/owned');
    }

    /**
     * Remove a member
     *
     * @param $iduser
     * @param $idclass
     * @return mixed
     */
    public function removeMember($iduser, $idclass)
    {
        $class = Classes::find($idclass);
        $user = User::find($iduser);
        if (!is_null($class)) {
            if (!is_null($user)) {
                if ($class->isOwner(Auth::id())) {
                    $permission = Permissions::where('id_user', '=', $iduser)->where('id_class', '=', $idclass)->first();
                    $permission->delete();
                    Session::put('toast', array('success', "User  " . $user->getSignature() . " has been removed from class " . $class->getName() . "."));
                } else {
                    Session::put('toast', array('error', "You don't have rights to remove users from the class " . $class->getName() . "."));
                }
            } else {
                Session::put('toast', array('error', "This user doesn't exist !"));
            }
        } else {
            Session::put('toast', array('error', "This class doesn't exist !"));
        }

        return Redirect::to('/classes/owned');
    }

    /**
     * Handle the modification of rights
     *
     * @param $iduser
     * @param $idclass
     * @return mixed
     */
    public function chgtRights($iduser, $idclass)
    {
        $class = Classes::find($idclass);
        $user = User::find($iduser);
        if (!is_null($class)) {
            if ($class->isOwner(Auth::id())) {
                if (!is_null($user)) {
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
                    Session::put('toast', array('success', "Rigths for member " . $user->getSignature() . " have been updated."));
                } else {
                    Session::put('toast', array('error', "This user doesn't exist."));
                }
            } else {
                Session::put('toast', array('error', "You don't have rights to modify user's rights in the class " . $class->getName() . "."));
            }
        } else {
            Session::put('toast', array('error', "This class doesn't exist"));
        }

        return Redirect::to('/classes/owned');
    }

    /**
     * Make the visibility change
     *
     * @param $idclass
     * @return mixed
     */
    public function chgtVisibility($idclass)
    {
        $class = Classes::find($idclass);

        if (!is_null($class)) {
            if ($class->isOwner(Auth::id())) {
                if ($class->visibility == 1) {
                    $class->visibility = 0;
                } else {
                    $class->visibility = 1;
                }
                $class->save();
                Session::put('toast', array('success', 'Visibility of class ' . $class->getName() . ' changed !'));
            } else {
                Session::put('toast', array('error', "You don't have rights to modify the class " . $class->getName() . " visibility."));
            }
        } else {
            Session::put('toast', array('error', "This class doesn't exist"));
        }

        return Redirect::to('/classes/owned');
    }

    /**
     *  Delete a class
     *
     * @param $idclass
     * @return mixed
     */
    public function removeClass($idclass)
    {
        $class = Classes::find($idclass);
        if (!is_null($class)) {
            if ($class->isOwner(Auth::id())) {
                $class = Classes::find($idclass);
                $class->delete();
                Session::put('toast', array('success', 'Class ' . $class->getName() . ' removed !'));
            } else {
                Session::put('toast', array('error', "You don't have rights to remove the class " . $class->getName() . " visibility."));
            }
        } else {
            Session::put('toast', array('error', "This class doesn't exist"));
        }

        return Redirect::to('/classes/owned');
    }

    /**
     * Resign from a class
     *
     * @param $idclass
     * @return mixed
     */
    public function resignClass($idclass)
    {
        $permission = Permissions::where('id_class', '=', $idclass)->where('id_user', '=', Auth::id());
        $permission->delete();
        Session::put('toast', array("success", "Class resign success !"));
        return Redirect::to('/classes/participant');
    }

    /**
     * Display the courses from a class
     *
     * @param $idclass
     * @return mixed
     */
    public function open($idclass)
    {
        $class = Classes::find($idclass);
        $courses = DB::table('courses')->where('id_class', $idclass)->join('classes', 'classes.id', '=', 'courses.id_class')->orderBy('courses.name')->get();
        $school = Schools::find($class->id_school);
        $city = Cities::find($school->id_location);
        $canton = Canton::find($city->id_canton);

        return View::make('classes.display')->with(array('class' => $class, 'courses' => $courses, 'school_name' => $school->name, 'school_city' => $city->name, 'canton' => $canton->name));
    }

    /**
     * Display the courses from a class
     *
     * @param $idclass
     * @return mixed
     */
    public function selectedClass($idclass)
    {
        $class = Classes::find($idclass);
        if (!is_null($class)) {
            if ($class->visibility == 1 || (Auth::check() && $class->canRead())) { //1 => public
                //Only for the classes's courses
                $courses = DB::table('courses')->where('id_class', $idclass)->orderBy('courses.name')->get();

                //Class informations
                $school = Schools::find($class->id_school);
                $city = Cities::find($school->id_location);
                $canton = Canton::find($city->id_canton);
                return View::make('courses.display')->with(array('class' => $class, 'courses' => $courses, 'school_name' => $school->name, 'school_city' => $city->name, 'canton' => $canton->name, 'title' => $class->name));

            } else {
                return Redirect::to('/unauthorized');
            }
        } else {
            Session::put('toast', array('error', "This class doesn't exist"));
            return Redirect::to('/classes/public');
        }
    }

    /**
     * Hanle the request of a user to join a class
     *
     * @param $idclass
     * @return mixed
     */
    public function join($idclass)
    {
        $class = Classes::find($idclass);
        $permission = new Permissions();
        $permission->id_class = $idclass;
        $permission->id_user = Auth::id();

        if (!is_null($class)) {
            $permission->id_rights = 0;
            $permission->save();
            Session::put('toast', array('success', 'Class successfully joinged. Now wait that the owner accepts you !'));

            $classOwner = $class->getOwner();

            Mail::send('emails.join', array('class' => $class, 'user' => Auth::user()), function ($message) use ($classOwner) {
                $message->to($classOwner->email, $classOwner->firstname + " " + $classOwner->lastname)
                    ->subject('New member')->from('arcnotesnoreply@gmail.com');
            });
        }
        return Redirect::to('/classes/participant');
    }

    /**
     * Display classes owned by the user in session
     * @return mixed
     */
    public function classOwned()
    {
        $classID = DB::table('permissions')->where('id_user', '=', Auth::id())->where('id_rights', '=', 15)->lists('id_class');

        if (!is_null($classID)) {
            if (count($classID) > 0) {
                $listClasses = DB::table('classes')->whereIn('id', $classID)->lists('name', 'id');
                $classesOwned = Classes::whereIn('id', $classID)->get();
                return View::make('classes.ownedclasses')->with(array('listClasses' => $listClasses, 'classesOwned' => $classesOwned));
            }
        }

        Session::put('toast', array('notice', 'You own no class, try to create one.'));
        return Redirect::to('/classes/create');
    }

    /**
     * Make the page to display all public classes that the user in session isn't already part of.
     *
     * @param $page
     * @return mixed
     */
    public function getPublic($page)
    {
        $take = 12;
        $skip = ($page - 1) * $take;
        $numberOfPages = 0;
        $classes_public = array();

        if (Auth::check()) {
            $listClass = DB::table('permissions')->where('id_user', '=', Auth::id())->lists('id_class');
            if (count($listClass) != 0) {
                $classes_public = Classes::where('visibility', '=', 1)->whereNotIn('id', $listClass)->skip($skip)->take($take)->get();
                $numberOfPages = Classes::where('visibility', '=', 1)->whereNotIn('id', $listClass)->count();
            }
            else{
                $classes_public = Classes::where('visibility', '=', 1)->skip($skip)->take($take)->get();
                $numberOfPages = Classes::where('visibility', '=', 1)->count();
            }

        } else {
            $classes_public = Classes::where('visibility', '=', 1)->skip($skip)->take($take)->get();
            $numberOfPages = Classes::where('visibility', '=', 1)->skip($skip)->take($take)->count();
        }
        $numberOfPages = ceil($numberOfPages / $take);

        return View::make('classes.public')->with(array('classes' => $classes_public, 'numberOfPages' => $numberOfPages, 'pageNo' => $page, 'title' => 'Public Classes'));

    }

    /**
     * Display the class you are in.
     *
     * @param $page
     * @return mixed
     */
    public function classParticipant($page)
    {
        $take = 12;
        $skip = ($page - 1) * $take;
        $listClass = DB::table('permissions')->where('id_user', '=', Auth::id())->where('id_rights','>','0')->lists('id_class');
        if (count($listClass) != 0) {
            $classes_public = Classes::whereIn('id', $listClass)->skip($skip)->take($take)->get();
            $numberOfPages = Classes::whereIn('id', $listClass)->count();
            $numberOfPages = ceil($numberOfPages / $take);

            if (count($classes_public) == 0) {
                $classes_public = array();
            }
        } else {
            $classes_public = array();
            $numberOfPages = 0;
        }

        return View::make('classes.userdisplay')->with(array('classes_public' => $classes_public, 'numberOfPages' => $numberOfPages, 'pageNo' => $page));
    }
}

















