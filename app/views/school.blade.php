@extends('layouts.default')
@section('body')
<div class="">
        <h2>new school</h2>
        <?php
        //TODO TEST
        echo Session::get('isLogged');

        $cantonList = DB::table('cantons')->lists('name','id');
        $cityList = DB::table('cities')->distinct()->lists('name','id');

        //TODO MODIFICATION
        ?>

        {{ Form::open(array('route' => array('school.store'), 'method' => 'post')) }}
        @if($errors->any())
            <div class="">
                <a class="" data-dismiss="alert">&times;</a>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </div>
        @endif
            {{Form::label('name','Name')}}
            {{Form::text('name', null,array('class' => ''))}}
        <br/>
            {{Form::label('canton','Canton')}}
            {{ Form::select('canton', $cantonList, null, array('class' => '')) }}
        <br/>

            {{Form::label('city','City')}}
            {{ Form::select('city', $cityList, null, array('class' => '')) }}
        <br/>
        {{Form::submit('Create', array('class' => ''))}}
        {{ Form::close() }}
</div>
@stop
