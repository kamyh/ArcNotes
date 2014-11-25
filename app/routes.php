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



Route::get("userTest", array(
    "as"=>"userTest",
    "uses"=>"UserController@test"
));

Route::get('/gestionClass', function()
{
    return View::make('users/gestionClass');
});

Route::resource('classes', 'ClassController');
Route::get('/createclass', array('as' => 'createclass', 'uses' => 'ClassController@createClass'));

Route::resource('courses', 'CourseController');
Route::get('/createcours', array('as' => 'createcours', 'uses' => 'CourseController@createcours'));

Route::resource('school', 'SchoolController');
Route::get('/school', array('as' => 'school', 'uses' => 'SchoolController@school')); //TODO pass to post method

Route::get('/signclass', function()
{
    return View::make('signclass');
});
Route::post('/signclass', array('as' => 'signclass', 'uses' => 'ClassController@load'));


Route::get('/joinclass', array('as' => 'joinclass', 'uses' => 'ClassController@join'));
/**
 * Login handling
 */

Route::resource('user', 'UserController'); // give acces to create and store fct for user controller
Route::get('/', array('as' => 'login', 'uses' => 'UserController@login'));
Route::get('/login', array('as' => 'login', 'uses' => 'UserController@login'));
Route::post('/login', array('as' => 'login', 'uses' => 'UserController@loginHandler'));
Route::post('/logout', array('as' => 'logout', 'uses' => 'UserController@logout'));

Route::get('searchcities/{id_canton}', 'SchoolController@fetch_sub_category');


/*
 * Routes Gestion Classes
 */

Route::post('/invite_member', array('as' => 'invite_member', 'uses' => 'ClassController@invite_member'));
Route::post('/accept_member', array('as' => 'accept_member', 'uses' => 'ClassController@accept_member'));
Route::post('/refuse_member', array('as' => 'refuse_member', 'uses' => 'ClassController@refuse_member'));
Route::post('/remove_course', array('as' => 'remove_course', 'uses' => 'ClassController@remove_course'));
Route::post('/remove_class', array('as' => 'remove_class', 'uses' => 'ClassController@remove_class'));
Route::post('/remove_member', array('as' => 'remove_member', 'uses' => 'ClassController@remove_member'));
Route::post('/chgt_rights', array('as' => 'chgt_rights', 'uses' => 'ClassController@chgt_rights'));
Route::post('/chgt_visibility', array('as' => 'chgt_visibility', 'uses' => 'ClassController@chgt_visibility'));
?>














