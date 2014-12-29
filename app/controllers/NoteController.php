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
                Session::put('toast',array('success','The note was created'));
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
        $note = Manuscrits::find($idnote);
        if(!is_null($note))
        {
            if($this->canUserDoActionOnNote($idnote,'edit'))
            {
                $rules = array(
                    'title' => "required|min:3|max:100",
                    'content' => 'required|min:10'
                );

                $validator = Validator::make(Input::all(), $rules);

                if (!$validator->fails()) {
                    $note->title = Input::get('title');
                    $note->content = Input::get('content');
                    $note->save();
                    $basenote = $note->getParent();
                    $idcourse = $basenote->id_cours;
                    Session::put('toast',array('success','The note was updated'));
                    return Redirect::to('course/open/'.$idcourse);
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
        else
        {
            return Redirect::to('/404');
        }
    }

    /**
     * remove the note given assuming user rights
     * @param $idnote the note id into database
     */
    public function removeNote($idnote)
    {
        //test if note exists
        $note = Manuscrits::find($idnote);
        if(!is_null($note))
        {
            //get the basenote parent
            $basenote = $note->getParent();
            //if user can edit and read
            if($this->canUserDoActionOnNote($idnote,'edit'))
            {
                //deletion
                $idcourse = $basenote->id_cours;
                $basenote->delete();
                $note->delete();
                Session::put('toast',array('success','The note was deleted'));
                return Redirect::to('course/open/'.$idcourse);
            }
            else
            {
                return Redirect::to('/unauthorized');
            }
        }
        else
        {
            return Redirect::to('/404');
        }
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
                $file = Input::file('file');
                $path = '/uploads' . '/' . $city . '/' . $schoolname . '/' . $schollaryear . '/' . $classname;
                $destinationPath = public_path() . $path;
                $extension = $file->getClientOriginalExtension();
                $filename = str_random(12) . '.' . $extension;
                $original_filename = $file->getClientOriginalName();
                $fileMIME = $file->getMimeType();

                $rules = array('file' => 'required|max:10000|mimes:doc,docx,txt,pdf,xls,xlsx,odt');
                $validator = Validator::make(Input::all(), $rules);

                if (!$validator->fails()) {
                    if ($file->isValid()) {
                        //laravel autommatically check if directory exists
                        $upload_success = Input::file('file')->move($destinationPath, $filename);
                        if ($upload_success) {
                            //if the upload is a success then insert into database the file
                            $token = bin2hex(BaseNotes::getNewToken());
                            $note = BaseNotes::firstOrCreate(array('id_author' => Auth::id(), 'id_cours' => $idcourse, 'token' => $token));
                            $file = Files::firstOrCreate(array('id_basenotes' => $note->getID(), 'path' => $path . '/' . $filename, 'original_filename' => $original_filename, 'mime' => $fileMIME));
                            Session::put('toast',array('success','The file was uploaded'));
                            return Redirect::to('course/open/' . $idcourse);
                        } else {
                            return Redirect::to('notes/add/'.$idcourse)->withErrors(array('the file upload failed'));
                        }
                    } else {
                        return Redirect::to('notes/add/'.$idcourse)->withErrors(array('The file was identified as invalid'));
                    }
                }
                else {
                    return Redirect::to('notes/add/'.$idcourse)->withErrors($validator);
                }
            } else {
                return Redirect::to('notes/add/'.$idcourse)->withErrors(array('No file was sent'));
            }
        }
        else return Redirect::to('/unauthorized');
    }

    public function downloadFile($idfile)
    {
        $file = Files::find($idfile);
        if(!is_null($file)) {
            if($this->canUserDoActionOnFile($idfile,'read')) {
                $pathToFile = public_path() . $file->getPath();
                if(is_file($pathToFile)) {
                    return Response::download($pathToFile, $file->getOriginalName(), array($file->getMIMEType()));
                }
                else {
                    return Redirect::to('/404');
                }
            }
        }
    }

    public function readNote($idnote)
    {
        $note = Manuscrits::find($idnote);
        if(!is_null($note)) {
            if($this->canUserDoActionOnNote($idnote,'read')) {
                $basenote = $note->getParent();
                $author = User::find($basenote->id_author);
                if(!is_null($author)) {
                    $author_string = $author->getSignature();
                }
                else {
                    $author_string = 'unknown author';
                }
                $last_update = $note->updated_at;
                return View::make('notes.readnote')->with(array('author' => $author_string, 'update' => $last_update,'title' => $note->title, 'content' => $note->content, 'idcourse' => 1));
            }
            else {
                return Redirect::to('/unauthorized');
            }
        }
        else {
            return Redirect::to('/404');
        }

    }

    public function readSharedNote($token)
    {
        //we get the basenote
        $basenote = BaseNotes::where('token','=',$token)->first();
        var_dump($basenote);
        echo $token;
        //if basenote exists
        if(!is_null($basenote))
        {
            //we try to get a written note
            $note = Manuscrits::where('id_basenotes','=',$basenote->getID())->first();
            if(!is_null($note))
            {
                $author = User::find($basenote->id_author);
                if(!is_null($author)) {
                    $author_string = $author->getSignature();
                }
                else {
                    $author_string = 'unknown author';
                }
                $last_update = $note->updated_at;
                return View::make('notes.readsharednote')->with(array('author' => $author_string, 'update' => $last_update,'title' => $note->title, 'content' => $note->content));
            }

            //we try to get a file
            $file = Files::where('id_basenotes','=',$basenote->getID())->first();
            if(!is_null($file))
            {
                $pathToFile = public_path() . $file->getPath();
                if(is_file($pathToFile)) {
                    return Response::download($pathToFile, $file->getOriginalName(), array($file->getMIMEType()));
                }
            }
        }
        return Redirect::to('/404');
    }

    /**
     * Remove the file given (file and database entry) assuming user having rights
     * @param $idfile
     */
    public function removeFileNote($idfile)
    {
        $file = Files::find($idfile);
        if(!is_null($file)) {
            if($this->canUserDoActionOnFile($idfile,'edit')) {
                //if the file does exist
                if(is_file($file->path)) {
                    //delete it
                    chmod($file->path, 0777);
                    unlink($file->path);
                }
                //delete the bdd entry anyway
                $basenote = $file->getParent();
                $idcourse = $basenote->id_cours;
                $basenote->delete();
                $file->delete();
                Session::put('toast',array('success','The file was deleted'));
                return Redirect::to('course/open/'.$idcourse);
            }
            else {
                return Redirect::to('/unauthorized');
            }
        }
        else {
            return Redirect::to('/404');
        }
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
