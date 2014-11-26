@extends('layouts.default')
@section('body')

    <h1> {{ $name }}</h1>

    <table>
        @foreach($filesManuscrit as $file)
            <tr>
                <td>{{ $file->title }}</td>
                <td>
                    {{ Form::open(array('route' => array('/notes/edit/{idnote}', 'idnote' => $file->id),'method' => 'get')); }}
                        {{ Form::submit('Edit',null, array('class' => 'button')); }}
                    {{Form::close();}}
                </td>
                <td>
                    {{ Form::open(array('route' => array('/notes/delete/{idnote}', 'idnote' => $file->id))); }}
                        {{ Form::submit('Delete',null, array('class' => 'button')); }}
                    {{Form::close();}}
                </td>
            </tr>
        @endforeach
    </table>

@stop