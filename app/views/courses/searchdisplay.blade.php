@extends('layouts.default')
@section('title')
    Search in Courses: {{{$keyword}}}
@endsection

@section('body')
    <div class="search-results">
        @foreach ($courses as $course)
            @if($course != null)
                <a href="/courses/open/{{{$course->id}}}" class="search-result color-a hover-color-b">{{{$course->name}}} <br/>in class {{{$course->getParentClass()->getName()}}} at {{{$course->getParentClass()->getSchoolName() .' '.$course->getParentClass()->getSchool()->getLocation()}}}</a>
            @endif
        @endforeach</div>
@endsection