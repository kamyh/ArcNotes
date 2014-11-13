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
            {{Form::text('school', null,array('class' => ''))}} <!-- TODO DropDown from existing school -->
            <!-- TODO new page for new scool Or store attributes already write by user and come back with it here after school creation -->
            <button onclick="openPopup()" class="btn btn-default">New School</button>
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

<script language="javascript" type="text/javascript">
    function openPopup()
    {
        newwindow = window.open('/school','New School','height=600,width=800');
        if (window.focus)
        {
            newwindow.focus()
        }
            return false;

    }
</script>
