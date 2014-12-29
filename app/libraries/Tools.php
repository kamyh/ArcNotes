<?php

class Tools
{
    public static function createToastMessages()
    {
        $js_string = "";
        if(Session::has('toast'))
        {
            $toast_array = Session::get('toast');
            if(is_array($toast_array))
            {
                if(count($toast_array) == 2)
                {
                    $js_string .= "$( document ).ready(function() {";
                    switch($toast_array[0])
                    {
                        case 'success': $js_string .= "$().toastmessage('showSuccessToast',\"". $toast_array[1] ."\");";
                            break;
                        case 'warning': $js_string .= "$().toastmessage('showWarningToast',\"". $toast_array[1] ."\");";
                            break;
                        case 'notice': $js_string .= "$().toastmessage('showNoticeToast',\"". $toast_array[1] ."\");";
                            break;
                        case 'error': $js_string .= "$().toastmessage('showErrorToast',\"". $toast_array[1] ."\");";
                            break;
                        default: $js_string .= "$().toastmessage('showNoticeToast',\"". $toast_array[1] ."\");";
                        break;
                    }
                    $js_string .= "});";
                }
            }
        }
        Session::forget('toast');
        return $js_string;
    }
}