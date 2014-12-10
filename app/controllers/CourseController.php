<?php

class CourseController extends \BaseController {

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
        return View::make('createcours')->with(array('idclass'=>$idclass));
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

        $rulesValidatorCours = array( 'name' => 'required|min:5','matter' => 'required|min:3');

        $validator = Validator::make($input, $rulesValidatorCours);

        if(!$validator->fails()) {

            $cours = new Courses();

            $cours->name = $input['name'];
            $cours->matter = $input['matter'];
            $cours->id_class = $input['idclass'];

            $cours->save();

            return Redirect::to('/');

        }
        else
        {
            return Redirect::to('courses/create/')->withErrors($validator)->with(array('idclass'=>$input['idclass']));
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

    public function open($idcourse)
    {
        $filesManuscrit = [];
        $files = [];

        $course = DB::table('courses')->where('id','=',$idcourse)->first();
        $id_basenotes = DB::table('basenotes')->where('id_cours','=',$idcourse)->lists('id');

        if(!empty($id_basenotes))
        {
            $filesManuscrit = DB::table('manuscrits')->whereIn('id', $id_basenotes)->get();
            $files = DB::table('files')->whereIn('id', $id_basenotes)->get();
        }

        return View::make('course.selectnote')->with(array('course' => $course, 'filesManuscrit' => $filesManuscrit, 'files' => $files));
    }

}
