@extends('layouts.default')
@section('body')

    <h1>Ajouter un fichier de note </h1>
    {{ Form::open(array('route' => array('/notes/upload/{idcourse}', 'idcourse' => $idcourse), 'files' => true)); }}
    <table class="form">
        <tr>
            <td>{{ Form::label('titre', 'Titre', array('class' => 'form-label')) }}</td>
            <td>{{ Form::text('titre', $titre, array('class' => 'text-input')); }}</td>
        </tr>
    </table>
    {{Form::close();}}
@stop


