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

    public function load()
    {
        $input = Input::All();
        Session::put('orderOption', $input['orderOption']);
        return View::make('signclass');
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
            return Redirect::to('gestionClass')->withErrors($error)->withInput();
        }
        else
        {
            $permission = new Permissions();
            $permission->id_user = $user_invited->id;
            $permission->id_class = $input['class'];
            $permission->id_rights = 1;

            $permission->save();

            return Redirect::to('gestionClass');
        }
    }

    public function accept_member()
    {
        $input = Input::all();

        $permission = Permissions::where('id_user','=',$input['id_user'])->where('id_class','=',$input['id_class'])->first();
        $permission->id_rights = 4;

        $permission->save();

        return Redirect::to('gestionClass');
    }

    public function refuse_member()
    {
        $input = Input::all();

        $permission = Permissions::where('id_user','=',$input['id_user'])->where('id_class','=',$input['id_class'])->first();

        $permission->delete();

        return Redirect::to('gestionClass');
    }

    public function remove_course()
    {
        $input = Input::all();

        $course = Courses::find($input['id_course']);
        $course->delete();

        return Redirect::to('gestionClass');
    }

    public function remove_member()
    {
        $input = Input::all();

        $permission = Permissions::where('id_user','=',$input['id_user'])->where('id_class','=',$input['id_class'])->first();

        $permission->delete();

        return Redirect::to('gestionClass');
    }

    public function chgt_rights()
    {
        $input = Input::all();

    }

    public function chgt_visibility()
    {
        $input = Input::all();

    }

    public function remove_class()
    {

    }


}
