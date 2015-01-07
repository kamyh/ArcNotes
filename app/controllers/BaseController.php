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
        $type = Input::get('type');
        $keyword = e(Input::get('keyword'));
        if ($keyword != null && $keyword != "") {
            return Redirect::to("/" . $type . "/search/" . $keyword);
        } else {
            Session::put("toast",array('error', 'Empty search.'));
            return Redirect::to('/');
        }
    }

}
