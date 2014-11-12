@extends('layouts.default')
@section('body')
<div class="">
        <h2>Register</h2>
        {{ Form::open(array('route' => array('user.store'), 'method' => 'post')) }}
        @if($errors->any())
            <div class="">
                <a class="" data-dismiss="alert">&times;</a>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </div>
        @endif
        <div class="">
            {{Form::label('firstname','First Name')}}
            {{Form::text('firstname', null,array('class' => ''))}}
        </div>
        <div class="">
            {{Form::label('lastname','Last Name')}}
            {{Form::text('lastname', null,array('class' => ''))}}
        </div>
        <div class="">
            {{Form::label('email','Email')}}
            {{Form::text('email', null,array('class' => ''))}}
        </div>
        <div class="">
            {{Form::label('password','Password')}}
            {{Form::password('password',array('class' => ''))}}
        </div>
        {{Form::submit('Register', array('class' => ''))}}
        {{ Form::close() }}
</div>
@stop