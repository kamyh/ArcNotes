@extends('layouts.default')
@section('title')
    Edit note
@endsection
@section('body')

    <h1>Modifier une note</h1>
    {{ Form::open(array('route' => array('/notes/update/{idnote}', 'idnote' => $idnote))); }}
    <table class="form">
        <tr>
            <td>{{ Form::label('title', 'Titre', array('class' => 'form-label')) }}</td>
            <td>{{ Form::text('title', $title, array('size' => 100, 'maxlength' => 100, 'class' => 'text-input')); }}</td>
        </tr>
        <tr>
            <td>{{ Form::label('content','Contenu', array('class' => 'form-label')); }}</td>
            <td>{{ Form::textarea('content', $content, array('cols' => 100, 'class' => 'textarea-input')); }}</td>
        </tr>
        <tr>
           <td>&nbsp;</td><td>{{ Form::submit('Sauvegarder !', array('class' => 'button')); }} {{ Form::submit('Terminer',null, array('class' => 'button')); }}</td>
        </tr>
    </table>
    {{Form::close();}}
@stop


