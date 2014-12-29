@extends('layouts.default')
@section('title')
    Read shared note
@endsection
@section('body')

    <h1>{{$title}}</h1>
    <div class="author">written by {{$author}} last update the {{$update}}</div>
    <div class="note-content">{{$content}}</div>
@stop


