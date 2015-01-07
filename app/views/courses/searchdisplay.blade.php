@extends('layouts.default')
@section('title')
    Search in Courses: {{$keyword}}
@endsection

@section('body')
    <div class="search-results">
        @foreach ($courses as $course)
            @if($course != null)
                <a href="#" class="search-result color-a hover-color-b">{{$course->name}} in class {{$course->getParentClass()->getName()}}</a>
            @endif
        @endforeach</div>
@endsection