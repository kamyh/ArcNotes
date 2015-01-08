<?php

class SchoolController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function schoolMaker()
    {
        return View::make('schools.school');
    }

    public function school()
    {
        return View::make('schools.school');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('schools.create');
    }

    /**
     * @return mixed
     */
    public function fetchSubCategory()
    {
        $input = Input::get('id_canton');
        $cities = DB::table('cities')->where('id_canton', '=', $input)->get();

        $options = array();
        foreach ($cities as $city) {
            $options += array($city->id => $city->name);
        }
        return Response::json($options);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
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

    public function saveSchool()
    {
        $inputs = Input::all();
        $rulesValidatorSchool = array('name_school' => array('required','min:4','regex:/^[a-zA-Z-àéèöïîêôâ]+$/'));
        $validator = Validator::make($inputs, $rulesValidatorSchool);
        $id_city = (int)$inputs['city'];

        if (!$validator->fails()) {
            $school = Schools::where('name', '=', $inputs['name_school'])->where('id_location', '=',$id_city)->first();
            if(is_null($school)) {
                $city = Cities::find($id_city);
                if (!is_null($city)) {
                    $school = new Schools();
                    $school->name = $inputs['name_school'];
                    $school->id_location = $id_city;
                    $school->save();
                    Session::put('toast', array('success', "School successfully created !"));
                    Session::put('selectSchool',$school->id);
                    return Redirect::to('/classes/create')->withInput();
                }
                else{
                    Session::put('toast', array('error', "This location does not exist, impossible to create school"));
                    return Redirect::to('/classes/create')->withInput();
                }
            }
            else{
                Session::put('toast', array('error', "This school already exists"));
                return Redirect::to('/classes/create')->withInput();
            }
        } else {
            return Redirect::to('/schools')->withErrors($validator)->withInput();
        }
    }

}
