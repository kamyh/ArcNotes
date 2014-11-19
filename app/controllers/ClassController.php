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
        return View::make('createclass');
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

        $rulesValidatorUser = array( 'name' => 'required|min:5','scollaryear' => 'required', 'school' => 'required', 'degree' => 'required', 'domain' => 'required');

        $validator = Validator::make($input, $rulesValidatorUser);

        if(!$validator->fails()) {

            $class = new Classes();

            $class->name = $input['name'];
            $class->scollaryear = $input['scollaryear'];
            $class->id_school = $input['school'];
            $class->degree = $input['degree'];
            $class->domain = $input['domain'];
            $class->visibility = $input['visibility'];

            $class->save();

            return Redirect::to('/');

        }
        else
        {
            return Redirect::to('createclass')->withErrors($validator)->withInput();
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



}
