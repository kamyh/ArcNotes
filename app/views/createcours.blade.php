@extends('layouts.default')
@section('body')
<div class="">
        <h2>new course</h2>
        <?php
            echo Session::get('isLogged');

            $schoolList = DB::table('courses')->lists('name','id');
        ?>
        {{ Form::open(array('route' => array('courses.store'), 'method' => 'post')) }}
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

        {{Form::submit('Create', array('class' => ''))}}
        {{ Form::close() }}
</div>
@stop
