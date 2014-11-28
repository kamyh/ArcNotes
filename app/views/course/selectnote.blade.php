@extends('layouts.default')
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
    </table>
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