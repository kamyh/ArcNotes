@extends('layouts.default')
@section('title')
    Search: {{$keyword}}
@endsection

@section('body')
    @foreach ($courses as $course)
    @if($course != null)
        {{$course->name}}
        @endif
    @endforeach
@endsection