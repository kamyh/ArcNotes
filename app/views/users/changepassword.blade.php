@extends('layouts.default')
@section('title')
    Change your password
@endsection
@section('body')
    <div class="class-creation-form color-a">
    {{ Form::open(array('url' => 'changepassword', 'method' => 'post')) }}
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
            <tr>
                <td>{{Form::label('new-password-1','New Password')}}</td>
                <td>{{Form::password('new-password-1',array('class' => ''))}}</td>
            </tr>
            <tr>
                <td>{{Form::label('new-password-2','Repeat New Password')}}</td>
                <td>{{Form::password('new-password-2',array('class' => ''))}}</td>
            </tr>
        <tr>
            <td>&nbsp;</td><td>{{Form::submit('Change password', array('class' => 'button'))}}</td>
        </tr>
    </table>
    </div>
@stop