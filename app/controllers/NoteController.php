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

        //TODO tester l'existence du cours et l'appartenance de l'utilisateur à la classe de celui-ci

        return View::make('notes.writenote')->with(array('idcourse' => $idcourse, 'nomcours' => 'test')); //retourné le nom du cours plutot que son id
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
        return 'asda';
    }

    /**
     * insert the new note into database assuming the user and having rights
     */
    public function saveNote($idcourse)
    {
        //TODO tester l'existence du cours, utilisateur logué, etc.
        //insertion de la note dans la base de données
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

}
