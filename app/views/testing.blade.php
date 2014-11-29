@extends('layouts.default')
@section('body')

    @foreach(Auth::user()->getClasses() as $class)
        {{$class->name}}
        <?php
            var_dump($class->getCourses());
        ?>
    @endforeach

    @include('class.userdisplay')
@stop
