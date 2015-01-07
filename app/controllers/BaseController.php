<?php

class BaseController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    public function getSearch()
    {
        ///http://stackoverflow.com/questions/17034616/laravel-load-method-in-another-controller-without-changing-the-url
        $type = Input::get('type');
        $keyword = Input::get('keyword');
        //return "yolo".$type.$keyword;
        //$request = Request::create("/".$type."/search/", 'GET', array('keyword'=> $keyword ));
        //Route::dispatch($request);
        return Redirect::to("/".$type."/search/".$keyword);
        /*
        if ($type == 'course')
            return CourseController::search($keyword);
        else
            return ClassController::search($keyword);*/
    }

}
