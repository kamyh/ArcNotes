@extends('layouts.default')
@section('title')
    TEST MOTHERTRUCKER
@endsection
@section('body')

    @foreach(Auth::user()->getClasses() as $class)
        <a href="/classes/open/{{$class->id}}" class="context-menu-tile hover-color-b"> <h2>{{$class->name}}</h2></a>
        @foreach($class->getCourses() as $course)
            <a href="/courses/open/{{$course->id}}" class="context-menu-tile hover-color-b">{{$course->name}}</a>
        @endforeach
    @endforeach

    @include('classes.userdisplay')
@stop
