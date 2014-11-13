@extends('layouts.default')
@section('body')
<div class="">
        <h2>new school</h2>
        <?php
        //TODO TEST
        echo Session::get('isLogged');

        //TODO MODIFICATION
        ?>

        {{ Form::open(array('route' => array('school.store'), 'method' => 'post')) }}
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
            {{Form::label('canton','Canton')}}
            @foreach($cantons as $canton)
                <?php
                    $cantonList = DB::table('cantons')->get();
                ?>
            @endforeach
            {{ Form::select('canton', $cantonList, null, array('class' => '')) }}
        </div>

        <div>
            {{Form::label('city','City')}}
            {{ Form::select('city', $cityList, null, array('class' => '')) }}
        </div>

        {{Form::submit('Create', array('class' => ''))}}
        {{ Form::close() }}
</div>
@stop
