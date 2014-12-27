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
        if($this->canUserDoActionOnNote($idnote,'edit'))
        {
            $note = Manuscrits::find($idnote);
            return View::make('notes.editnote')->with(array('idnote' => $idnote, 'title' => $note->getTitle(), 'content' => $note->getContent()));
        }
        return Redirect::to('404');
    }

    /**
     * create and return the uploading form (view)
     * @param $idcourse
     * @return the uploading file view
     */
    public function getUploadingForm($idcourse)
    {
        if($this->canUserWriteNote($idcourse)) {
            $course = Courses::find($idcourse);
            return View::make('notes.uploadnote')->with(array('idcourse' => $idcourse, 'course' => $course->name));
        }
        return Redirect::to('unauthorized');
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
                $note = BaseNotes::firstOrCreate(array('id_author' => Auth::id(), 'id_cours' => $idcourse, 'token' => $token));
                Manuscrits::firstOrCreate(array('id_basenotes' => $note->getID(), 'content' => Input::get('content'), 'title' => Input::get('title')));
                return Redirect::to('course/open/'.$idcourse);
            }
            else
            {
                return Redirect::to('notes/write/'.$idcourse)->withErrors($validator)->withInput();
            }
        }
        else
        {
            return Redirect::to('/unauthorized');
        }
    }

    /**
     * Update the note content assuming the user having rights
     * @param $idnote the note id into database
     */
    public function updateNote($idnote)
    {
        if($this->canUserDoActionOnNote($idnote,'edit'))
        {
            $rules = array(
                'title' => "required|min:3|max:100",
                'content' => 'required|min:10'
            );

            $validator = Validator::make(Input::all(), $rules);

            echo $validator->fails();
            if (!$validator->fails()) {
                $note = Manuscrits::find($idnote);
                $note->title = Input::get('title');
                $note->content = Input::get('content');
                $note->save();
                return Redirect::to('notes/edit/'.$idnote);
            }
            else
            {
                return Redirect::to('notes/edit/'.$idnote)->withErrors($validator)->withInput();
            }
        }
        else
        {
            return Redirect::to('unauthorized');
        }
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

        //before all we have to check if user can uplaod anything in the course
        //writing a note is the same as upoad a file
        if($this->canUserWriteNote($idcourse)) {
            if (input::hasFile('file')) {

                //we get all information that concern the course to get the directory hierarchy path
                $course = Courses::find($idcourse);
                $idclass = $course->getClassID();
                $class = Classes::find($idclass);
                $classname = $class->getName();
                $schollaryear = $class->getSchollarName();
                $schoolname = $class->getSchoolName();
                $city = $class->getCitie();
                $sizeInMegabytes = 30; //max file size in MegaBytes
                $maxfilesize = $sizeInMegabytes * 1024 * 1024; // calculate how many octets does it make
                $accepted_extensions = array('pdf', 'docx', 'doc', 'odt', 'ppt','pptx','txt'); //to complete
                $file = Input::file('file');
                $path = '/uploads' . '/'. $city . '/' . $schoolname . '/'. $schollaryear. '/' . $classname;
                $destinationPath = public_path() . $path;
                $extension = $file->getClientOriginalExtension();
                $filename = str_random(12) . '.' . $extension;
                $original_filename = $file->getClientOriginalName();
                $filesize = $file->getClientSize();
                $fileMIME = $file->getMimeType();


                if (in_array($extension, $accepted_extensions)) {
                    if ($filesize <= $maxfilesize) {
                        if ($file->isValid()) {
                            //laravel autommatically check if directory exists
                            $upload_success = Input::file('file')->move($destinationPath, $filename);
                            if ($upload_success) {
                                //if the upload is a success then insert into database the file
                                $token = bin2hex(BaseNotes::getNewToken());
                                $note = BaseNotes::firstOrCreate(array('id_author' => Auth::id(), 'id_cours' => $idcourse, 'token' => $token));
                                $file = Files::firstOrCreate(array('id_basenotes' => $note->getID(), 'path' => $path. '/' . $filename, 'original_filename' => $original_filename,'mime' => $fileMIME));
                                return Redirect::to('course/open/'.$idcourse);
                            }
                            else {
                                echo 'fail';
                            }
                        }
                        else {
                            echo 'file invalid';
                        }
                    }
                    else {
                        echo 'file too big';
                    }
                }
                else {
                    echo 'unauthorized extension';
                }
            }
            else{
                echo 'no file received';
            }
        }
        else{

        }
    }

    public function downloadFile($idfile)
    {
        $file = Files::find($idfile);
        if(!is_null($file))
        {
            if($this->canUserDoActionOnFile($idfile,'read')) {
                $pathToFile = public_path() . $file->getPath();
                return Response::download($pathToFile, $file->getOriginalName(), array($file->getMIMEType()));
            }
        }
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

    private function canUserDoActionOnNote($idnote, $action)
    {
        $note = Manuscrits::find($idnote);
        //does the note exist
        if(!is_null($note)) {
            $basenote = $note->getParent();
            $course = Courses::find($basenote->getParentCourseID());
            $class = Classes::find($course->getClassID());


            if (!is_null($class)) {
                $perms = $class->getPermissionsTab(Auth::Id());
                if ($perms[$action]) {
                    return true;
                }
            }
        }
        return false;
    }

    private function canUserDoActionOnFile($idfile, $action)
    {
        $file = Files::find($idfile);
        //does the note exist
        if(!is_null($file)) {
            $basenote = $file->getParent();
            $course = Courses::find($basenote->getParentCourseID());
            $class = Classes::find($course->getClassID());


            if (!is_null($class)) {
                $perms = $class->getPermissionsTab(Auth::Id());
                if ($perms[$action]) {
                    return true;
                }
            }
        }
        return false;
    }
}
