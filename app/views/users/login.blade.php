@extends('layouts.default')
@section('body')
{{ Form::open(array('url' => 'login', 'method' => 'post')) }}
    @if($errors->any())
        <div class="">
            <a class="" data-dismiss="alert">&times;</a>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </div>
    @endif
    {{Form::label('email','Email')}}
    {{Form::text('email', null,array('class' => 'form-control'))}}
    {{Form::label('password','Password')}}
    {{Form::password('password',array('class' => 'form-control'))}}
    {{Form::submit('Login', array('class' => 'btn btn-primary'))}}
{{ Form::close() }}


@stop