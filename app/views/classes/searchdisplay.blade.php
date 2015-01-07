@extends('layouts.default')
@section('title')
    Search in classes: {{$keyword}}
@endsection

@section('body')
    <div class="search-results">
    @foreach ($classes as $class)
    @if($class != null)
        <a href="#" class="search-result color-a hover-color-b">{{$class->name}}</a>
        @endif
    @endforeach</div>
@endsection