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
    "as" => "userTest",
    "uses" => "UserController@test"
));


Route::get('/about', function () {
    return View::make('about');
});

Route::get('/404', function () {
    return View::make('error.404');
});

Route::get('/unauthorized', function () {
    return View::make('error.unauthorized');
});

Route::get('/', function () {
    return View::make('hello');
});


Route::resource('courses', 'CourseController');
Route::get('/courses/create/{idclass}', array('before' => 'auth', 'as' => '/courses/create/{idclass}', 'uses' => 'CourseController@createcours'))->where('idclass', '[0-9]+');


Route::resource('schools', 'SchoolController');
Route::post('/schools', array('as' => '/schools', 'uses' => 'SchoolController@school'));


/**
 * Login handling
 */

Route::resource('users', 'UserController'); // give acces to create and store fct for user controller
Route::get('/login', array('as' => 'login', 'uses' => 'UserController@login'));
Route::post('/login', array('as' => 'login', 'uses' => 'UserController@loginHandler'));
Route::post('/logout', array('as' => 'logout', 'uses' => 'UserController@logout'));

Route::get('/cities/search/{id_canton}', 'SchoolController@fetch_sub_category');

/*
 * Routes Gestion Classes
 */
Route::post('/classes/member/invite', array('as' => '/classes/member/invite', 'uses' => 'ClassController@inviteMember'));
Route::get('/classes/member/accept/{iduser}/{idclass}', array('before' => 'auth', 'as' => '/classes/member/accept/{iduser}/{idclass}', 'uses' => 'ClassController@acceptMember'))->where('iduser', '[0-9]+');
Route::get('/classes/member/refuse/{iduser}/{idclass}', array('before' => 'auth', 'as' => '/classes/member/refuse/{iduser}/{idclass}', 'uses' => 'ClassController@refuseMember'))->where('iduser', '[0-9]+');
Route::get('/courses/remove/{idcourse}', array('before' => 'auth', 'as' => '/courses/remove/{idcourse}', 'uses' => 'ClassController@removeCourse'))->where('idcourse', '[0-9]+');
Route::get('/classes/remove/{idclass}', array('before' => 'auth', 'as' => '/classes/remove/{idclass}', 'uses' => 'ClassController@removeClass'))->where('idclass', '[0-9]+');
Route::get('/classes/resign/{idclass}', array('before' => 'auth', 'as' => '/classes/resign/{idclass}', 'uses' => 'ClassController@resignClass'))->where('idclass', '[0-9]+');
Route::get('/classes/member/remove/{iduser}/{idclass}', array('before' => 'auth', 'as' => '/classes/member/remove/{iduser}/{idclass}', 'uses' => 'ClassController@removeMember'))->where('idclass', '[0-9]+');
Route::get('/classes/rights/change/{iduser}/{idclass}', array('before' => 'auth', 'as' => '/classes/rights/change/{iduser}/{idclass}', 'uses' => 'ClassController@chgtRights'))->where('iduser', '[0-9]+');
Route::get('/classes/visibility/change/{idclass}', array('before' => 'auth', 'as' => '/classes/visibility/change/{idclass}', 'uses' => 'ClassController@chgtVisibility'))->where('idclass', '[0-9]+');
//Route::get('/class/open/{idclass}',array('before' => 'auth','as'=> '/class/open/{idnote}', 'uses' => 'ClassController@open'))->where('idclass','[0-9]+');
Route::get('/classes/public/{page}', array('as' => '/classes/public/{page}', 'uses' => 'ClassController@getPublic'))->where('idclass', '[0-9]+');
Route::get('/classes/public', function () {
    return Redirect::to('classes/public/1');
});
Route::get('/classes/participant/{page}', array('before' => 'auth', 'as' => '/classes/participant/{page}', 'uses' => 'ClassController@classParticipant'))->where('idclass', '[0-9]+');
Route::get('/classes/participant/', function () {
    return Redirect::to('/classes/participant/1');
});
Route::get('/classes/owned', array('before' => 'auth', 'as' => '/classes/owned', 'uses' => 'ClassController@classOwned'));

Route::post('/classes/join', array('as' => '/classes/join', 'uses' => 'ClassController@load'));
Route::get('/classes/sign/{idclass}', array('before' => 'auth', 'as' => '/classes/sign/{idclass}', 'uses' => 'ClassController@join'))->where('idclass', '[0-9]+');
Route::resource('classes', 'ClassController');
Route::get('/classes/create', array('before' => 'auth', 'as' => '/classes/create', 'uses' => 'ClassController@createClass'));


Route::get('/classes/display/{idclass}', array('as' => '/class/display/{idclass}', 'uses' => 'ClassController@selectedClass'));

/* verify email */
Route::get('/register/verify/{confirmationCode}', array('as' => '/register/verify/{confirmationCode}','uses' => 'UserController@confirm'))->where('confirmationCode', '[a-bA-B0-9]+');

Route::get('/verify/{token}', array('as' => '/verify/{token}', 'uses' => 'UserController@confirm'));

/*
 * TEST Routes
 */

Route::get("lists_classes_courses", array(
    "as" => "lists_classes_courses",
    "uses" => "ClassController@lists_classes_courses"
));

Route::get("lists_classes", array(
    "as" => "lists_classes",
    "uses" => "ClassController@lists_classes"
));

/*
 * Course
 */
Route::get('/courses/open/{idcourse}', array('as' => '/courses/open/{course}', 'uses' => 'CourseController@open', 'before' => 'auth'))->where('idcourse', '[0-9]+');

Route::get('/search', 'BaseController@getSearch');
Route::get('/courses/search/{keyword}', 'CourseController@search');
Route::get('/classes/search/{keyword}', 'ClassController@search');

/*
 * notes management routes
 */
Route::get('/notes/write/{idcourse}', array('as' => '/notes/write/{idcourse}', 'uses' => 'NoteController@getWritingForm', 'before' => 'auth'))->where('idcourse', '[0-9]+');
Route::post('/notes/save/{idcourse}', array('as' => '/notes/save/{idcourse}', 'uses' => 'NoteController@saveNote', 'before' => 'auth|csrf'))->where('idcourse', '[0-9]+');
Route::get('/notes/edit/{idnote}', array('as' => '/notes/edit/{idnote}', 'uses' => 'NoteController@getEditingForm', 'before' => 'auth'))->where('idnote', '[0-9]+');
Route::post('/notes/delete/{idnote}', array('as' => '/notes/delete/{idnote}', 'uses' => 'NoteController@removeNote', 'before' => 'auth'))->where('idnote', '[0-9]+');
Route::post('/notes/update/{idnote}', array('as' => '/notes/update/{idnote}', 'uses' => 'NoteController@updateNote', 'before' => 'auth|csrf'))->where('idnote', '[0-9]+');
Route::post('/notes/ajaxsave/{idnote}', array('as' => '/notes/ajaxsave/{idnote}', 'uses' => 'NoteController@ajaxSaveNote', 'before' => 'auth'))->where('idnote', '[0-9]+');
Route::get('/notes/add/{idcourse}', array('as' => '/notes/add/{idcourse}', 'uses' => 'NoteController@getUploadingForm', 'before' => 'auth'))->where('idcourse', '[0-9]+');
Route::post('/notes/upload/{idcourse}', array('as' => '/notes/upload/{idcourse}', 'uses' => 'NoteController@uploadFileNote', 'before' => 'auth|csrf'))->where('idcourse', '[0-9]+');
Route::get('/notes/download/{idfile}', array('as' => '/notes/download/{idfile}', 'uses' => 'NoteController@downloadFile', 'before' => 'auth'))->where('idfile', '[0-9]+');
Route::post('/notes/deletefile/{idfile}', array('as' => '/notes/deletefile/{idfile}', 'uses' => 'NoteController@removeFileNote', 'before' => 'auth'))->where('idfile', '[0-9]+');
Route::get('/notes/read/{idnote}', array('as' => '/notes/read/{idnote}', 'uses' => 'NoteController@readNote', 'before' => 'auth'))->where('idnote', '[0-9]+');
Route::get('/notes/shared/{token}', array('as' => '/notes/shared/{token}', 'uses' => 'NoteController@readSharedNote'))->where('token', '[a-f0-9]+'); //hexadecimal token
