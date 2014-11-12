<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}

    /**
     * Display login form
     *
     */
    public function login()
    {
        return View::make('users.login');
    }

    /**
     * Handle login stuff
     */
    public function loginHandler()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        //print_r($data);

        print_r(Auth::user());

        var_dump(Auth::attempt(array('email' => $email, 'password' => $password),true));



        if(Auth::attempt(array('email' => $email, 'password' => $password),true))
        {
            echo "TRUE";
            //return Redirect::to('/');
        }
        echo "FALSE";
        //return Redirect::route('login')->withInput();
    }

    /**
     * User disconnection
     */
    public function logout()
    {
        if(Auth::check()){
            Auth::logout();
        }

        return Redirect::route('/');
    }
	


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
     *
	 */
	public function store()
	{
        /*
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $email = Input::get('email');
        $password = Hash::make(Input::get('password'));

        $newUser = User::create(array($firstname,$lastname,$email,$password));

        if($newUser){
            Auth::login($newUser);
            return Redirect::to('/');
        }

        return Redirect::route('user.create')->withInput();
        */

        $input = Input::all();

        $rules = array( 'firstname' => 'required','lastname' => 'required', 'password' => 'required');


        $password = $input['password'];
        $password = Hash::make($password);

        $user = new User();

        $user->email = $input['email'];
        $user->password = $password;
        $user->save();

        return Redirect::to('/');


	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        echo "***";
        $user = DB::table('users')->where('id', $id)->first();
        echo "++++";
        echo $user->lastname;
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
	
	public function insertIntoDB($firstname, $lastname, $email, $password)
	{
        //TODO echappement
        echo "TR";
        $id = DB::table('users')->insertGetId(
            array('firstname' => $firstname,'lastname' => $lastname,'email' => $email,'password' => $password)
        );
	}

    public function test()
    {
        echo "PLOP";
        $this->show(1);
    }
	


}
