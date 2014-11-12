@extends('layouts.default')
@section('body')
<div class="">
        <h2>Signning</h2>
        {{ Form::open(array('route' => array('classes.store'), 'method' => 'post')) }}
        @if($errors->any())
            <div class="">
                <a class="" data-dismiss="alert">&times;</a>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </div>
        @endif
        <div class="">
            {{Form::label('name','Name')}}
            {{Form::text('name', null,array('class' => ''))}}
        </div>
        <div class="">
            {{Form::label('scollaryear','Scollar Year')}}
            {{Form::text('scollaryear', null,array('class' => ''))}}
        </div>
        {{Form::submit('Sign', array('class' => ''))}}
        {{ Form::close() }}
</div>
@stop