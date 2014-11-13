@extends('layouts.default')
@section('body')
<div class="">
        <h2>new class</h2>
        <?php
        echo Session::get('isLogged');
        ?>
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
        <div>
            {{Form::label('school','School')}}
            {{Form::text('school', null,array('class' => ''))}}
        </div>
        <div>
            {{Form::label('degree','Degree')}}
            {{Form::text('degree', null,array('class' => ''))}}
        </div>
        <div class="">
            {{Form::label('scollaryear','Scollar Year')}}
            {{Form::text('scollaryear', null,array('class' => ''))}}
        </div>
        <div class="">
            {{Form::label('domain','Domain')}}
            {{Form::text('domain', null,array('class' => ''))}}
        </div>
        {{Form::submit('Sign', array('class' => ''))}}
        {{ Form::close() }}
</div>
@stop

