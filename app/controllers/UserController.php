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
        $rulesValidatorUser = array( 'password' => 'required','email' => 'required');

        $input = Input::All();

        $validator = Validator::make($input, $rulesValidatorUser);

        if(!$validator->fails())
        {

            $email = Input::get('email');
            $password = Input::get('password');

            if (Auth::attempt(array('email' => $email, 'password' => $password), true))
            {
                Session::put('isLogged', '1');
                Session::put('id',$id = Auth::id());
                return Redirect::to('/');
            }
            return Redirect::to('login')->withInput();

        }
        else
        {
            return Redirect::to('login')->withErrors($validator)->withInput();
        }
    }

    /**
     * User disconnection
     */
    public function logout()
    {
        if(Auth::check())
        {
            Session::flush();
            Auth::logout();
        }

        return Redirect::to('/');
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
        $input = Input::all();

        $rulesValidatorUser = array( 'firstname' => 'required|min:4','lastname' => 'required', 'password' => 'required|min:8','email' => 'required|email');

        $validator = Validator::make($input, $rulesValidatorUser);

        if(!$validator->fails()) {

            $password = $input['password'];
            $password = Hash::make($password);

            $user = new User();

            $user->email = $input['email'];
            $user->password = $password;
            $user->save();

            return Redirect::to('/');

        }
        else
        {
            return Redirect::to('user/create')->withErrors($validator)->withInput();
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
