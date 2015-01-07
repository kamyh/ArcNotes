@extends('layouts.default')
@section('title')
    Login
@endsection
@section('body')
{{ Form::open(array('url' => 'login', 'method' => 'post')) }}
    <table>
     @if($errors->has())
    <tr>
        <td colspan="2">
    @foreach ($errors->all() as $error)
        <div class="error">{{ $error }}</div>
    @endforeach
        </td>
    </tr>
    @endif
        <td>{{Form::label('email','Email')}}</td>
        <td>{{Form::text('email', null,array('class' => ''))}}</td>
    </tr>
    <tr>
        <td>{{Form::label('password','Password')}}</td>
        <td>{{Form::password('password',array('class' => ''))}}</td>
    </tr>
    <tr>
        <td>&nbsp;</td><td>{{Form::submit('Login', array('class' => 'button'))}}</td>
    </tr>
{{ Form::close() }}

{{ Form::open(array('url' => 'logout', 'method' => 'post')) }}
    {{Form::submit('Logout', array('class' => 'button'))}}
{{ Form::close() }}
</table>

@stop