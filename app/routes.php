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
Route::get('/createclass', array('as' => 'createclass', 'uses' => 'ClassController@createClass'));

Route::resource('courses', 'CourseController');
Route::get('/createcours', array('as' => 'createcours', 'uses' => 'CourseController@createcours'));

Route::resource('school', 'SchoolController');
Route::get('/school', array('as' => 'school', 'uses' => 'SchoolController@school')); //TODO pass to post method


/**
 * Login handling
 */

Route::resource('user', 'UserController'); // give acces to create and store fct for user controller
Route::get('/login', array('as' => 'login', 'uses' => 'UserController@login'));
Route::post('/login', array('as' => 'login', 'uses' => 'UserController@loginHandler'));
Route::post('/logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
?>
