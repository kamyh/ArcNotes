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
     *
     *
     */
    public function createCours($idclass)
    {
        $schoolList = DB::table('courses')->lists('name', 'id');
        return View::make('courses.createcours')->with(array('idclass' => $idclass, 'schoolList' => $schoolList));
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
        $rulesValidatorCourse = array('name' => 'required|min:5', 'matter' => 'required|min:3');
        $validator = Validator::make($input, $rulesValidatorCourse);

        if (!$validator->fails()) {
            $course = new Courses();
            $course->name = $input['name'];
            $course->matter = $input['matter'];
            $course->id_class = $input['idclass'];
            $course->save();

            return Redirect::to('/courses/open/' . $course->getID());
        } else {
            return Redirect::to('courses/create')->withErrors($validator)->with(array('idclass' => $input['idclass']));
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
        //todo: get get only courses which are public/accessible?
        $courses = Courses::where('name', 'LIKE', "%".$keyword."%")->get();
        return View::make('courses.searchdisplay')->with(array('courses' => $courses, 'keyword' => $keyword));
    }

    public function open($idcourse)
    {
        $course = Courses::find($idcourse);
        if (!is_null($course)) {
            $manuscrits = DB::table('basenotes')->where('id_cours', $course->id)->join('manuscrits', 'manuscrits.id_basenotes', '=', 'basenotes.id')->orderBy('title')->get();
            $files = DB::table('basenotes')->where('id_cours', $course->id)->join('files', 'files.id_basenotes', '=', 'basenotes.id')->get();

            if (count($manuscrits) == 0) $manuscrits = array();
            if (count($files) == 0) $files = array();
            return View::make('courses.selectnote')->with(array('course' => $course, 'manuscrits' => $manuscrits, 'files' => $files));
        }
        return Redirect::to('/404');
    }

}
