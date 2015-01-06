@extends('layouts.default')
@section('title')
    Search: {{$keyword}}
@endsection

@section('body')
    @foreach ($classes as $class)
    @if($class != null)
        {{$class->name}}
        @endif
    @endforeach
@endsection