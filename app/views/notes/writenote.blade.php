@extends('layouts.default')
@section('title')
    Write a new note in {{{ $nomcours }}}
@endsection
@section('body')
    <div class="class-creation-form color-a">
    {{ Form::open(array('route' => array('/notes/save/{idcourse}', 'idcourse' => $idcourse))); }}
    <table class="form">
     @if($errors->has())
        <tr>
            <td colspan="2">
        @foreach ($errors->all() as $error)
           <div class="error">{{{ $error }}}</div>
       @endforeach
        </td>
       </tr>
     @endif
        <tr>
            <td>{{ Form::label('title', 'Title', array('class' => 'form-label')) }}</td>
            <td>{{ Form::text('title', null, array('class' => 'text-input')); }}</td>
        </tr>
        <tr>
            <td>{{ Form::label('content','Content', array('class' => 'form-label')); }}</td>
            <td>{{ Form::textarea('content', null, array('class' => 'textarea-input')); }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>{{ Form::submit('Create !',array('class' => 'button')); }}</td>
        </tr>
    </table>
    </div>
    {{Form::close();}}
@stop


