<?php

class UserController extends \BaseController
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
        $rulesValidatorUser = array('password' => 'required', 'email' => 'required|email');
        $input = Input::All();
        $validator = Validator::make($input, $rulesValidatorUser);

        if (!$validator->fails()) {
            $email = Input::get('email');
            $password = Input::get('password');
            if (Auth::attempt(array('email' => $email, 'password' => $password), true)) {
                $error = "This user doesn't exist";

                if(Auth::User()->isActivated()) {
                    Session::put('toast', array('success', 'You are logged in !'));
                    return Redirect::to('/')->withErrors($error);
                }
                else{
                    Session::put('toast', array('error', 'Please check your email to verify your account !'));
                    return Redirect::to('/')->withErrors($error);

                }
            }
        }
        return Redirect::to('/')->withErrors($validator)->withInput();
    }

    /**
     * User disconnection
     */
    public function logout()
    {
        Auth::logout();
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
        $rulesValidatorUser = array('firstname' => 'required|min:4', 'lastname' => 'required', 'password' => 'required|min:8', 'email' => 'required|email');
        $validator = Validator::make($input, $rulesValidatorUser);

        if (!$validator->fails()) {

            $password = $input['password'];
            $password = Hash::make($password);
            $user = new User();
            $confirmation_code = str_random(30);
            $user->email = $input['email'];
            $user->password = $password;
            $user->lastname = $input['lastname'];
            $user->firstname = $input['firstname'];
            $user->confirmation_code = $confirmation_code;
            $user->save();

            //TODO
            Mail::send('emails.verify', array('confirmation_code' => $confirmation_code), function ($message) {
                $message->to(Input::get('email'), Input::get('firstname') + " " + Input::get('lastname'))
                    ->subject('Verify your email address')->from('arcnotesnoreply@gmail.com');
            });
            Session::put('toast', array('success', 'You sign successfully. Please check your mail to activate your account !'));
            return Redirect::to('/');
        } else {
            return Redirect::to('user/create')->withErrors($validator)->withInput();
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
        $user = User::find($id);
        echo $user->lastname;
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


    public function confirm($confirmationCode)
    {
        $user = User::where('confirmation_code','=',$confirmationCode)->first();

        if($user)
        {
            $user->confirmation_code = -1;
            $user->save();
            Session::put('toast', array('success', 'Your account have been succesfully verify !'));
        }


        return Redirect::to('/');
    }
}
