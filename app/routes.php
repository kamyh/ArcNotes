<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');

});

Route::get("userTest", array(
    "as"=>"userTest",
    "uses"=>"UserController@test"
));

Route::resource('classes', 'ClassController');
Route::get('/signclass', array('as' => 'signclass', 'uses' => 'ClassController@signClass'));

Route::resource('school', 'SchoolController');
Route::get('/school', array('as' => 'school', 'uses' => 'SchoolController@school')); //TODO pass to post method
Route::post('/school', array('as' => 'school', 'uses' => 'SchoolController@schoolMaker'));

Route::get('cantons', function()
{
    $cantons = Canton::all();

    return View::make('cantons')->with('cantons', $cantons);
});

/**
 * Login handling
 */

Route::resource('user', 'UserController'); // give acces to create and store fct for user controller
Route::get('/login', array('as' => 'login', 'uses' => 'UserController@login'));
Route::post('/login', array('as' => 'login', 'uses' => 'UserController@loginHandler'));
Route::post('/logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
?>
