@extends('layouts.default')
@section('body')
<div class="">
        <h2>sign class</h2>
        <?php
        //TODO TEST
        echo Session::get('isLogged');

        $classesList = DB::table('classes')->lists('name','id');

        //TODO MODIFICATION
        ?>

        @foreach($classesList as $key => $value)
            <p>class {{ $value }}</p>

        {{ Form::open(array('route' => array('joinclass'), 'method' => 'post')) }}

            {{ Form::hidden('id', $key) }}
            {{Form::submit('Join', array('class' => ''))}}
        {{ Form::close() }}


        @endforeach
</div>
@stop
