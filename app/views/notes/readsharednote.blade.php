@extends('layouts.default')
@section('title')
    Read Note: {{$title}}
@endsection
@section('body')
    <div class = "class-creation-form color-a max-60">
        <div class="note-content">{{{nl2br($content)}}}</div>
    <div class="note-footer">Written by {{{$author}}}. <br/>Last update on the {{{$update}}}.</div>
    </div>
@stop


