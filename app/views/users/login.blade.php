@extends('layouts.default')
@section('title')
    Login
@endsection
@section('body')
{{ Form::open(array('url' => 'login', 'method' => 'post')) }}
    @if($errors->any())
        <div class="error">
            <a class="" data-dismiss="alert">&times;</a>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </div>
    @endif
    {{Form::label('email','Email')}}
    {{Form::text('email', null,array('class' => ''))}}        <br/>

    {{Form::label('password','Password')}}
    {{Form::password('password',array('class' => ''))}}        <br/>

    {{Form::submit('Login', array('class' => ''))}}
{{ Form::close() }}

{{ Form::open(array('url' => 'logout', 'method' => 'post')) }}
    {{Form::submit('Logout', array('class' => ''))}}
{{ Form::close() }}

@stop