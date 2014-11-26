@extends('layouts.default')
@section('body')

    <h1>Rédiger une note dans {{ $nomcours }}</h1>
    {{ Form::open(array('route' => array('/notes/save/{id}', 'id' => $idcourse))); }}
    <table class="form">
        <tr>
            <td>{{ Form::label('titre', 'Titre', array('class' => 'form-label')) }}</td>
            <td>{{ Form::text('titre', null, array('class' => 'text-input')); }}</td>
        </tr>
        <tr>
            <td>{{ Form::label('content','Contenu', array('class' => 'form-label')); }}</td>
            <td>{{ Form::textarea('content', null, array('class' => 'textarea-input')); }}</td>
        </tr>
        <tr>
            <td></td><td>{{ Form::submit('Enregistrer !',null, array('class' => 'button')); }}</td>
        </tr>
    </table>
    {{Form::close();}}
@stop


