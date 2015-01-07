@extends('layouts.default')
@section('title')
    Upload note
@endsection
@section('body')

    <h1>Add a file in {{$course}} </h1>
    <div class="class-creation-form color-a">
    {{ Form::open(array('route' => array('/notes/upload/{idcourse}', 'idcourse' => $idcourse), 'files' => true)); }}
    <table class="form">
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
            <td>{{ Form::label('file', 'Sélectionnez un fichier', array('class' => 'form-label')) }}</td>
            <td>{{ Form::file('file', array('class' => 'file-input')); }}</td>
            <td>{{ Form::submit('Upload !',array('class' => 'button')); }}</td>
        </tr>
    </table>
    </div>
    {{Form::close();}}
@stop