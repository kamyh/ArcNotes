@extends('layouts.default')
@section('title')
    {{ $course->name }}
@endsection
@section('body')

    <h1> {{ $course->name }}</h1>

    <table style="border: solid 1px #ffffff">
        <tr>
            <td>Created at</td>
            <td>{{$course->created_at}}</td>
        </tr>
        <tr>
            <td>Last update</td>
            <td>{{$course->updated_at}}</td>
        </tr>
        <tr>
            <td>Matter</td>
            <td>{{$course->matter}}</td>
        </tr>
        <tr>
            <td>
                {{ Form::open(array('route' => array('/notes/write/{idcourse}', 'idcourse' => $course->id),'method' => 'get')); }}
                    {{ Form::submit('Write Note',null, array('class' => 'button')); }}
                {{Form::close();}}
            </td>
            <td>
                {{ Form::open(array('route' => array('/notes/add/{idcourse}', 'idcourse' => $course->id),'method' => 'get')); }}
                    {{ Form::submit('Add Note',null, array('class' => 'button')); }}
                {{Form::close();}}
            </td>
        </tr>
    </table>
    <h2>Written notes</h2>
    <table>
        @foreach($manuscrits as $file)
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
    <h2>Files</h2>
     <table>
            @foreach($files as $file)
                <tr>
                    <td>{{ $file->original_filename }}</td>
                    <td>{{ Files::find($file->id)->getSize(); }}</td>
                    <td>
                        {{Form::open(array('route' => array('/notes/download/{idfile}', 'idfile' => $file->id), 'method' => 'get')); }}
                        {{ Form::submit('Download', null, array('class' => 'button')); }}
                        {{Form::close();}}
                    </td>
                </tr>
            @endforeach
     </table>

@stop