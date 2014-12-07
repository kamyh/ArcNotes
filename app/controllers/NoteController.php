<?php

class NoteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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


    /**
     * create and return the new note writing form
     * @return writing note form view
     */
    public function getWritingForm($idcourse)
    {

        if($this->canUserWriteNote($idcourse)) {
            $course = Courses::find($idcourse);

            return View::make('notes.writenote')->with(array('idcourse' => $idcourse, 'nomcours' => $course->getName())); //retourner le nom du cours plutot que son id
        }
    }

    /**
     * create and return the editing note view
     * @param $idnote the note id into database
     * @return editing view
     */
    public function getEditingForm($idnote)
    {
        //TODO tester l'existence du cours et l'appartenance de l'utilisateur à la classe de celui-ci

        return View::make('notes.editnote')->with(array('idnote' => $idnote, 'titre' => 'Titre de la note', 'content' => 'contenu')); //retourné le nom du cours plutot que son id
    }

    /**
     * create and return the uploading form (view)
     * @param $idcourse
     * @return the uploading file view
     */
    public function getUploadingForm($idcourse)
    {
        return View::make('notes.uploadnote')->with('idcourse',$idcourse);
    }

    /**
     * insert the new note into database assuming the user having rights
     */
    public function saveNote($idcourse)
    {
        //assuming the user is connected
        if($this->canUserWriteNote($idcourse)) {
            $rules = array(
                'title' => "required|min:3|max:100",
                'content' => 'required|min:10'
            );

            $validator = Validator::make(Input::all(), $rules);

            if (!$validator->fails()) {
                $token = bin2hex(BaseNotes::getNewToken());
                $note = BaseNotes::create(array('id_author' => Auth::id(), 'id_cours' => $idcourse, 'token' => $token));
                Manuscrits::create(array('id_basenotes' => $note->getID(), 'content' => Input::get('content'), 'title' => Input::get('title')));
                return Redirect::to('course/open/'.$idcourse);
            }
            else
            {
                return Redirect::to('notes/write/'.$idcourse)->withErrors($validator)->withInput();
            }
        }
        else
        {

        }
    }

    /**
     * Update the note content assuming the user having rights
     * @param $idnote the note id into database
     */
    public function updateNote($idnote)
    {

    }

    /**
     * remove the note given assuming user rights
     * @param $idnote the note id into database
     */
    public function removeNote($idnote)
    {

    }

    /**
     * upload a new note file into the given course assuming the user having rights
     * @param $idcourse
     */
    public function uploadFileNote($idcourse)
    {

    }

    /**
     * Remove the file given (file and database entry) assuming user having rights
     * @param $idfile
     */
    public function removeFileNote($idfile)
    {

    }

    private function canUserWriteNote($idcourse)
    {
        //check if user can write into course
        //get the class id from the course
        $course = Courses::find($idcourse);
        if(!is_null($course)) {
            $idclass = $course->getClassID();
            $class = Classes::find($idclass);
            $perms = $class->getPermissionsTab(Auth::id());

            //if user can write something
            if($perms['create'])
            {
                return true;
            }
        }
        return false;
    }

}
