<?php

class CourseController extends \BaseController
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
     * @param $idclass
     * @return mixed
     */
    public function createCours($idclass)
    {
        if (Classes::find($idclass)->canCreate()) {
            $schoolList = DB::table('courses')->lists('name', 'id');
            return View::make('courses.createcours')->with(array('idclass' => $idclass, 'schoolList' => $schoolList));
        }
        return Redirect::to('/unauthorized');
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
     * @param
     */
    public function store()
    {
        $input = Input::all();
        $rulesValidatorCourse = array('name' => array('required', 'between:3,120', 'regex:/^[a-zA-Z0-9-àéèöïêôâîüç ]+$/'), 'matter' => array('required', 'between:3,120', 'regex:/^[a-zA-Z0-9-àéèöïêôâîüç ]+$/'));
        $validator = Validator::make($input, $rulesValidatorCourse);
        $class = Classes::find((int)$input['idclass']);
        if (!is_null($class)) {
            if (!$validator->fails()) {
                $course = new Courses();
                $course->name = $input['name'];
                $course->matter = $input['matter'];
                $course->id_class = $class->id;
                $course->save();

                return Redirect::to('/courses/open/' . $course->getID());
            } else {
                return Redirect::to('courses/create/' . $class->id)->withErrors($validator)->with(array('idclass' => $input['idclass']))->withInput();
            }
        } else {
            return Redirect::to('/404');
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
    public function edit($idcourse,$idclass)
    {
        if (Classes::find($idclass)->canCreate()) {
            $course = Courses::find($idcourse);
            $schoolList = DB::table('courses')->lists('name', 'id');
            return View::make('courses.edit')->with(array('course' => $course,'idclass' => $idclass, 'schoolList' => $schoolList));
        }
        return Redirect::to('/unauthorized');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update()
    {
        $input = Input::all();
        $rulesValidatorCourse = array('name' => array('required', 'min:5', 'regex:/^[a-zA-Z0-9-àéèöïêôâî]+$/'), 'matter' => array('required', 'min:3', 'regex:/^[a-zA-Z0-9-àéèöïêôâî]+$/'));
        $validator = Validator::make($input, $rulesValidatorCourse);
        $class = Classes::find((int)$input['idclass']);
        if (!is_null($class)) {
            if (!$validator->fails()) {
                $course = Courses::find($input['idcourse']);
                $course->name = $input['name'];
                $course->matter = $input['matter'];
                $course->id_class = $class->id;
                $course->save();

                return Redirect::to('/courses/open/' . $course->getID());
            } else {
                return Redirect::to('courses/create/' . $class->id)->withErrors($validator)->with(array('idclass' => $input['idclass']))->withInput();
            }
        } else {
            return Redirect::to('/404');
        }
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

    public function search($keyword)
    {
        $query = "SELECT courses.id AS id_course, courses.name AS course, classes.name AS class, classes.id AS id_class, schools.name AS school, cities.name AS city, cantons.name AS canton FROM courses INNER JOIN classes ON classes.id=courses.id_class INNER JOIN schools on Schools.id=classes.id_school INNER JOIN cities ON cities.id = schools.id_location INNER JOIN cantons ON cantons.id = cities.id_canton WHERE classes.visibility=1 AND courses.name LIKE '%$keyword%' ORDER BY schools.name";
        $courses = DB::select($query);//->get()->lists('schoools.name', 'schools.id');
        return View::make('courses.searchdisplay')->with(array('courses' => $courses, 'keyword' => $keyword));
    }

    public function open($idcourse)
    {
        $course = Courses::find($idcourse);
        if (!is_null($course)) {
            if ($course->getParentClass()->canRead()) {
                $manuscrits = DB::table('basenotes')->where('id_cours', $course->id)->join('manuscrits', 'manuscrits.id_basenotes', '=', 'basenotes.id')->orderBy('title')->get();
                $files = DB::table('basenotes')->where('id_cours', $course->id)->join('files', 'files.id_basenotes', '=', 'basenotes.id')->get();

                if (count($manuscrits) == 0) $manuscrits = array();
                if (count($files) == 0) $files = array();
                return View::make('courses.listnotes')->with(array('course' => $course, 'manuscrits' => $manuscrits, 'files' => $files));
            }
            return Redirect::to('/unauthorized');
        } else {
            return Redirect::to('/404');
        }
    }
}
