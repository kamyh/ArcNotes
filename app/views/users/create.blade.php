@extends('layouts.default')
@section('title')
    Register
@endsection
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
            {{Form::label('firstname','First Name')}}
            {{Form::text('firstname', null,array('class' => ''))}}
                <br/>

            {{Form::label('lastname','Last Name')}}
            {{Form::text('lastname', null,array('class' => ''))}}
           <br/>

            {{Form::label('email','Email')}}
            {{Form::text('email', null,array('class' => ''))}}
               <br/>

            {{Form::label('password','Password')}}
            {{Form::password('password',array('class' => ''))}}
           <br/>

        {{Form::submit('Register', array('class' => 'button'))}}
        {{ Form::close() }}
</div>
@stop