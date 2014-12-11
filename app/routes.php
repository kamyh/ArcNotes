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

Route::resource('classes', 'ClassController');
Route::get('/class/create', array('as' => '/class/create', 'uses' => 'ClassController@createClass'));

Route::resource('courses', 'CourseController');
Route::get('/courses/create', array('as' => '/courses/create', 'uses' => 'CourseController@createcours'));

Route::resource('school', 'SchoolController');
Route::get('/school', array('as' => '/school', 'uses' => 'SchoolController@school')); //TODO pass to post method

Route::get('/class/join', function()
{
    return View::make('signclass');
});
Route::post('/class/join', array('as' => '/class/join', 'uses' => 'ClassController@load'));


Route::post('/class/sign', array('as' => '/class/sign', 'uses' => 'ClassController@join'));
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

Route::post('/class/invite', array('as' => '/class/invite', 'uses' => 'ClassController@invite_member'));
Route::post('/class/accept', array('as' => '/class/accept', 'uses' => 'ClassController@accept_member'));
Route::post('/class/refuse', array('as' => '/class/refuse', 'uses' => 'ClassController@refuse_member'));
Route::post('/course/remove', array('as' => '/course/remove', 'uses' => 'ClassController@remove_course'));
Route::post('/class/remove', array('as' => '/class/remove', 'uses' => 'ClassController@remove_class'));
Route::post('/class/resign', array('as' => '/class/resign', 'uses' => 'ClassController@resign_class'));
Route::post('/member/remove', array('as' => '/member/remove', 'uses' => 'ClassController@remove_member'));
Route::post('/rights/change', array('as' => '/rights/change', 'uses' => 'ClassController@chgt_rights'));
Route::post('/visibility/change', array('as' => '/visibility/change', 'uses' => 'ClassController@chgt_visibility'));

Route::get('/manager/classowned', array('as' => '/manager/classowned', 'uses' => 'ClassController@class_owned'));


Route::get('/class/open/{idclass}',array('before' => 'auth','as'=> '/class/open/{idnote}', 'uses' => 'ClassController@open'))->where('idclass','[0-9]+');
Route::get('/class/public/',array('before' => 'auth','as'=> '/class/public/', 'uses' => 'ClassController@getpublic'));


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
 * Routes pour gestions notes
 */
Route::get('/notes/write/{idcourse}',array('as' => '/notes/write/{idcourse}', 'uses' => 'NoteController@getWritingForm', 'before' => 'auth'))->where('idcourse','[0-9]+');
Route::post('/notes/save/{idcourse}',array('as' => '/notes/save/{idcourse}', 'uses' =>'NoteController@saveNote', 'before' => 'auth|csrf'))->where('idcourse','[0-9]+');
Route::get('/notes/edit/{idnote}',array('as'=> '/notes/edit/{idnote}', 'uses' => 'NoteController@getEditingForm', 'before' => 'auth'))->where('idnote','[0-9]+');
Route::post('/notes/delete/{idnote}',array('as'=> '/notes/delete/{idnote}', 'uses' => 'NoteController@removeNote', 'before' => 'auth'))->where('idnote','[0-9]+');
Route::post('/notes/update/{idnote}',array('as'=> '/notes/update/{idnote}', 'uses' => 'NoteController@updateNote', 'before' => 'auth'))->where('idnote','[0-9]+');
Route::get('/notes/add/{idcourse}',array('as'=> '/notes/add/{idcourse}', 'uses' => 'NoteController@getUploadingForm', 'before' => 'auth'))->where('idcourse','[0-9]+');
Route::post('/notes/upload/{idcourse}',array('as'=> '/notes/upload/{idcourse}', 'uses' => 'NoteController@uploadFileNote', 'before' => 'auth|csrf'))->where('idcourse','[0-9]+');
Route::post('/notes/deletefile/{idfile}',array('as'=> '/notes/deletefile/{idfile}', 'uses' => 'NoteController@removeFileNote', 'before' => 'auth'))->where('idfile','[0-9]+');
