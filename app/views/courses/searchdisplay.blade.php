@extends('layouts.default')
@section('title')
    Search in Courses: {{{$keyword}}}
@endsection

@section('body')
    <div class="search-results">
        @foreach ($courses as $course)
            @if($course != null)
                <a href="/courses/open/{{{$course->id_course}}}" class="search-result color-a hover-color-b">{{{$course->course}}} <br/>in class {{{$course->class}}} at {{{$course->school .' '.$course->city}}}</a>
            @endif
        @endforeach</div>
@endsection