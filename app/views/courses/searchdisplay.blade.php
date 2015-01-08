@extends('layouts.default')
@section('title')
    Search in Courses: {{{$keyword}}}
@endsection

@section('body')
    <div class="search-results">
    @if(count($courses) > 0)
        @foreach ($courses as $course)
            @if($course != null)
                <div class="search-result color-a"><a href="/courses/open/{{{$course->id_course}}}" class="color-a link hover-color-b" title="open course">{{{$course->course}}}</a><br/>in class <a href="/classes/display/{{{$course->id_class}}}" class="color-a link hover-color-b" title="show class">{{{$course->class}}}</a> at {{{$course->school .' '.$course->city}}}</div>
            @endif
        @endforeach
    @else
        <div class="class-creation-form color-a">No results.</div>
    @endif
    </div>
@endsection