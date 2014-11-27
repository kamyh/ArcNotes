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

Route::get('/gestionclassowner',array('before' => 'auth', function()
{
    return View::make('users/gestionclassowner');
}));

Route::get('/gestionclasspart', function()
{
    return View::make('users/gestionclasspart');
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

Route::get('/lateralmanu', function()
{
    return View::make('lateralmanu');
});

/*
 * Routes Gestion Classes
 */

Route::post('/invite_member', array('as' => 'invite_member', 'uses' => 'ClassController@invite_member'));
Route::post('/accept_member', array('as' => 'accept_member', 'uses' => 'ClassController@accept_member'));
Route::post('/refuse_member', array('as' => 'refuse_member', 'uses' => 'ClassController@refuse_member'));
Route::post('/remove_course', array('as' => 'remove_course', 'uses' => 'ClassController@remove_course'));
Route::post('/remove_class', array('as' => 'remove_class', 'uses' => 'ClassController@remove_class'));
Route::post('/resign_class', array('as' => 'resign_class', 'uses' => 'ClassController@resign_class'));
Route::post('/remove_member', array('as' => 'remove_member', 'uses' => 'ClassController@remove_member'));
Route::post('/chgt_rights', array('as' => 'chgt_rights', 'uses' => 'ClassController@chgt_rights'));
Route::post('/chgt_visibility', array('as' => 'chgt_visibility', 'uses' => 'ClassController@chgt_visibility'));

/*
 * TEST Routes
 */

Route::get("lists_classes_courses", array(
    "as"=>"lists_classes_courses",
    "uses"=>"ClassController@lists_classes_courses"
));


/*
 * Routes pour gestions notes
 */
Route::get('/notes/write/{idcourse}',array('as' => '/notes/write/{idcourse}', 'uses' => 'NoteController@getWritingForm', 'before' => 'auth'))->where('idcourse','[0-9]+');
Route::post('/notes/save/{id}',array('as' => '/notes/save/{id}', 'uses' =>'NoteController@saveNote', 'before' => 'auth'))->where('id','[0-9]+');
Route::get('/notes/edit/{idnote}',array('as'=> '/notes/edit/{idnote}', 'uses' => 'NoteController@getEditingForm', 'before' => 'auth'))->where('idnote','[0-9]+');
Route::post('/notes/delete/{idnote}',array('as'=> '/notes/delete/{idnote}', 'uses' => 'NoteController@removeNote', 'before' => 'auth'))->where('idnote','[0-9]+');
Route::post('/notes/update/{idnote}',array('as'=> '/notes/update/{idnote}', 'uses' => 'NoteController@updateNote', 'before' => 'auth'))->where('idnote','[0-9]+');
Route::get('/notes/add/{idcourse}',array('as'=> '/notes/add/{idcourse}', 'uses' => 'NoteController@getUploadingForm', 'before' => 'auth'))->where('idcourse','[0-9]+');
Route::post('/notes/upload/{idcourse}',array('as'=> '/notes/upload/{idcourse}', 'uses' => 'NoteController@uploadFileNote', 'before' => 'auth'))->where('idcourse','[0-9]+');
Route::post('/notes/deletefile/{idfile}',array('as'=> '/notes/deletefile/{idfile}', 'uses' => 'NoteController@removeFileNote', 'before' => 'auth'))->where('idfile','[0-9]+');
