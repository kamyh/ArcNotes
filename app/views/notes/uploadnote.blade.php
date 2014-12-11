@extends('layouts.default')
@section('title')
    Upload note
@endsection
@section('body')

    <h1>Ajouter un fichier de note </h1>
    {{ Form::open(array('route' => array('/notes/upload/{idcourse}', 'idcourse' => $idcourse), 'files' => true)); }}
    <table class="form">
        <tr>
            <td>{{ Form::label('file', 'Sélectionnez un fichier', array('class' => 'form-label')) }}</td>
            <td>{{ Form::file('file', null, array('class' => 'file-input')); }}</td>
        </tr>
    </table>
    {{Form::close();}}
@stop