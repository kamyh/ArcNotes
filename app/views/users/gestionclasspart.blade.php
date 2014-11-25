@extends('...layouts.default')
@section('body')

    @if(Session::get('isLogged') == 1)
        <?php
            $classID = DB::table('permissions')->where('id_user','=',Session::get('id'))->where('id_rights','<',15)->lists('id_class');
            if($classID != null)
            {
                $listClasses = DB::table('classes')->whereIn('id',$classID)->lists('name','id');

                var_dump($listClasses);
            }
        ?>

        @foreach($listClasses as $class)

        @endforeach
    @endif
@stop
