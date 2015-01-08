@extends('layouts.default')
@section('title')
    Read note: {{$title}}
@endsection
@section('body')
    <div class="class-creation-form color-a max-60">
        <div class="note-content">{{{nl2br($content)}}}</div>
        <div class="note-footer">Written by {{{$author}}}.<br/> Last update on the {{{$update}}}.<a href="/courses/open/{{{$idcourse}}}" title="go back to course" alt="go back to course" class="note-footer-link color-b">Go back to course</a></div>
    </div>
@stop


