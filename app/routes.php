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


Route::get('/testing', function()
{
    return View::make('testing');
});

Route::get('/404', function()
{
    return View::make('error/404');
});

Route::get('/unauthorized', function()
{
    return View::make('error/unauthorized');
});

Route::get('/', function()
{
    return View::make('hello');
});


Route::resource('courses', 'CourseController');
Route::get('/courses/create/{idclass}', array('before' => 'auth','as' => '/courses/create/{idclass}', 'uses' => 'CourseController@createcours'))->where('idclass','[0-9]+');


Route::resource('school', 'SchoolController');
Route::get('/school', array('as' => '/school', 'uses' => 'SchoolController@school')); //TODO pass to post method


/**
 * Login handling
 */

Route::resource('user', 'UserController'); // give acces to create and store fct for user controller
Route::get('/login', array('as' => 'login', 'uses' => 'UserController@login'));
Route::post('/login', array('as' => 'login', 'uses' => 'UserController@loginHandler'));
Route::post('/logout', array('as' => 'logout', 'uses' => 'UserController@logout'));

Route::get('searchcities/{id_canton}', 'SchoolController@fetch_sub_category');
//TODO Test permissions

/*
 * Routes Gestion Classes
 */
Route::post('/class/invite', array('as' => '/class/invite', 'uses' => 'ClassController@invite_member'));
Route::get('/class/accept/{iduser}/{idclass}', array('before' => 'auth','as' => '/class/accept/{iduser}/{idclass}', 'uses' => 'ClassController@accept_member'))->where('iduser','[0-9]+');
Route::get('/class/refuse/{iduser}/{idclass}', array('before' => 'auth','as' => '/class/refuse/{iduser}/{idclass}', 'uses' => 'ClassController@refuse_member'))->where('iduser','[0-9]+');
Route::get('/course/remove/{idcourse}', array('before' => 'auth','as' => '/course/remove/{idcourse}', 'uses' => 'ClassController@remove_course'))->where('idcourse','[0-9]+');
Route::get('/class/remove/{idclass}', array('before' => 'auth','as' => '/class/remove/{idclass}', 'uses' => 'ClassController@remove_class'))->where('idclass','[0-9]+');
Route::get('/class/resign/{idclass}', array('before' => 'auth','as' => '/class/resign/{idclass}', 'uses' => 'ClassController@resign_class'))->where('idclass','[0-9]+');
Route::get('/member/remove/{iduser}/{idclass}', array('before' => 'auth','as' => '/member/remove/{iduser}/{idclass}', 'uses' => 'ClassController@remove_member'))->where('idclass','[0-9]+');
Route::get('/rights/change/{iduser}/{idclass}', array('before' => 'auth','as' => '/rights/change/{iduser}/{idclass}', 'uses' => 'ClassController@chgt_rights'))->where('iduser','[0-9]+');
Route::get('/visibility/change/{idclass}', array('before' => 'auth','as' => '/visibility/change/{idclass}', 'uses' => 'ClassController@chgt_visibility'))->where('idclass','[0-9]+');
Route::get('/class/open/{idclass}',array('before' => 'auth','as'=> '/class/open/{idnote}', 'uses' => 'ClassController@open'))->where('idclass','[0-9]+');
Route::get('/class/public/{page}', array('as' => '/class/public/{page}', 'uses' => 'ClassController@getpublic'))->where('idclass','[0-9]+');
Route::get('/class/participant/{page}', array('as' => '/class/participant/{page}', 'uses' => 'ClassController@classParticipant'))->where('idclass','[0-9]+');
Route::post('/class/join', array('as' => '/class/join', 'uses' => 'ClassController@load'));
Route::get('/class/sign/{idclass}', array('before' => 'auth','as' => '/class/sign/{idclass}', 'uses' => 'ClassController@join'))->where('idclass','[0-9]+');
Route::resource('classes', 'ClassController');
Route::get('/class/create', array('before' => 'auth','as' => '/class/create', 'uses' => 'ClassController@createClass'));

Route::get('/manager/classowned', array('as' => '/manager/classowned', 'uses' => 'ClassController@class_owned'));




/*
 * TEST Routes
 */

Route::get("lists_classes_courses", array(
    "as"=>"lists_classes_courses",
    "uses"=>"ClassController@lists_classes_courses"
));

Route::get("lists_classes", array(
    "as"=>"lists_classes",
    "uses"=>"ClassController@lists_classes"
));

/*
 * Course
 */
Route::get('/course/open/{idcourse}',array('before' => 'auth','as'=> '/course/open/{course}', 'uses' => 'CourseController@open'))->where('idcourse','[0-9]+');


/*
 * notes management routes
 */
Route::get('/notes/write/{idcourse}',array('as' => '/notes/write/{idcourse}', 'uses' => 'NoteController@getWritingForm', 'before' => 'auth'))->where('idcourse','[0-9]+');
Route::post('/notes/save/{idcourse}',array('as' => '/notes/save/{idcourse}', 'uses' =>'NoteController@saveNote', 'before' => 'auth|csrf'))->where('idcourse','[0-9]+');
Route::get('/notes/edit/{idnote}',array('as'=> '/notes/edit/{idnote}', 'uses' => 'NoteController@getEditingForm', 'before' => 'auth'))->where('idnote','[0-9]+');
Route::post('/notes/delete/{idnote}',array('as'=> '/notes/delete/{idnote}', 'uses' => 'NoteController@removeNote', 'before' => 'auth'))->where('idnote','[0-9]+');
Route::post('/notes/update/{idnote}',array('as'=> '/notes/update/{idnote}', 'uses' => 'NoteController@updateNote', 'before' => 'auth'))->where('idnote','[0-9]+');
Route::get('/notes/add/{idcourse}',array('as'=> '/notes/add/{idcourse}', 'uses' => 'NoteController@getUploadingForm', 'before' => 'auth'))->where('idcourse','[0-9]+');
Route::post('/notes/upload/{idcourse}',array('as'=> '/notes/upload/{idcourse}', 'uses' => 'NoteController@uploadFileNote', 'before' => 'auth|csrf'))->where('idcourse','[0-9]+');
Route::post('/notes/deletefile/{idfile}',array('as'=> '/notes/deletefile/{idfile}', 'uses' => 'NoteController@removeFileNote', 'before' => 'auth'))->where('idfile','[0-9]+');
