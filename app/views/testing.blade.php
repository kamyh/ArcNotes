@extends('layouts.default')
@section('body')

    @foreach(Auth::user()->getClasses() as $class)
        <a href="/class/open/{{$class->id}}" class="context-menu-tile hover-color-b"> <h2>{{$class->name}}</h2></a>
        @foreach($class->getCourses() as $course)
            <a href="/course/open/{{$course->id}}" class="context-menu-tile hover-color-b">{{$course->name}}</a>
        @endforeach
    @endforeach

    @include('class.userdisplay')
@stop
