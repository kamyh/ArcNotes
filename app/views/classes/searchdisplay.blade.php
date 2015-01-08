@extends('layouts.default')
@section('title')
    Search in classes: {{{$keyword}}}
@endsection

@section('body')
    <div class="search-results">
    @if(count($classes))
    @foreach ($classes as $class)
    @if($class != null)
        <a href="/classes/display/{{{$class->id}}}" class="search-result color-a hover-color-b">{{{$class->name}}}
        </a>
        @endif
    @endforeach
    @else
    <div class="class-creation-form color-a">No result.</div>
    @endif
    </div>
@endsection