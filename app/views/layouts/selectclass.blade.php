@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('body')
    <table>
            <tr>
                <td><h2> {{ $class[0]->name }} </h2></td>
            </tr>
            <tr>
                <td>Created at </td>
                <td> {{ $class[0]->created_at }} </td>
            </tr>
            <tr>
                <td>Last update </td>
                <td> {{ $class[0]->updated_at }} </td>
            </tr>
            <tr>
                <td>{{$school_name}}</td>
                <td>{{$school_city}}</td>
                <td>{{$canton}}</td>
            </tr>
            <tr>
                <td>Scollar year</td>
                <td>{{$class[0]->scollaryear}}</td>
            </tr>
            <tr>
                <td>Degree</td>
                <td>{{$class[0]->degree}}</td>
            </tr>
            <tr>
                <td>Domain</td>
                <td>{{$class[0]->domain}}</td>
            </tr>
            <tr>
                <td>Visibility</td>
                <td>{{$class[0]->visibility}}</td>
            </tr>
            <tr>
                <td>
                    {{ Form::open(array('route' => array('/courses/create/{idclass}', 'idclass' => $class[0]->id),'method' => 'get')); }}
                        {{ Form::submit('New Course', array('class' => 'button')) }}
                    {{Form::close();}}
                </td>
            </tr>
        </table>
    @yield('display')
@stop