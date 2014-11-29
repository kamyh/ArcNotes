@extends('layouts.default')
@section('body')

    @foreach(Auth::user()->getClasses() as $class)
        <?php
            var_dump($class->getCourses());

        ?>
    @endforeach
@stop
