@extends('layouts.default')
@section('title')
    Register
@endsection
@section('body')
<div class="class-creation-form color-a">
    <table class="color-a">
        {{ Form::open(array('route' => array('users.store'), 'method' => 'post')) }}
        @if($errors->signup->has())
            <tr>
                <td colspan="2">
                @foreach ($errors->signup->all() as $error)
                   <div class="error">{{ $error }}</div>
                @endforeach
                </td>
            </tr>
        @endif
        <tr>
            <td>{{Form::label('firstname','First Name')}}</td>
            <td>{{Form::text('firstname', null,array('class' => ''))}}</td>
        </tr>
        <tr>
            <td>{{Form::label('lastname','Last Name')}}</td>
            <td>{{Form::text('lastname', null,array('class' => ''))}}</td>
        </tr>
        <tr>
            <td>{{Form::label('email','Email')}}</td>
            <td>{{Form::text('email', null,array('class' => ''))}}</td>
        </tr>
        <tr>
            <td>{{Form::label('password','Password')}}</td>
            <td>{{Form::password('password',array('class' => ''))}}</td>
        </tr>
        <tr>
        <td>&nbsp</td><td>{{Form::submit('Register', array('class' => 'button'))}}</td>
        </tr>
        {{ Form::close() }}
    </table>
</div>
@stop