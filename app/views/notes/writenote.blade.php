@extends('layouts.default')
@section('title')
    Write a note
@endsection
@section('body')

    <h1>Rédiger une note dans {{ $nomcours }}</h1>
    {{ Form::open(array('route' => array('/notes/save/{idcourse}', 'idcourse' => $idcourse))); }}
    <table class="form">
        <tr>
            <td>{{ Form::label('title', 'Titre', array('class' => 'form-label')) }}</td>
            <td>{{ Form::text('title', null, array('class' => 'text-input')); }}</td>
        </tr>
        <tr>
            <td>{{ Form::label('content','Contenu', array('class' => 'form-label')); }}</td>
            <td>{{ Form::textarea('content', null, array('class' => 'textarea-input')); }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>{{ Form::submit('Enregistrer !',null, array('class' => 'button')); }}</td>
        </tr>
    </table>
    {{Form::close();}}
@stop


