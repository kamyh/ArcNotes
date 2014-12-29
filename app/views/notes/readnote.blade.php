@extends('layouts.default')
@section('title')
    Edit note
@endsection
@section('body')

    <h1>{{$title}}</h1>
    <div class="author">written by {{$author}} last update the {{$update}}</div>
    <div class="note-content">{{$content}}</div>
    <div class="return-link"><a href="/course/open/{{$idcourse}}" title="go back to course" alt="go back to course">go back to course</a></div>
@stop


