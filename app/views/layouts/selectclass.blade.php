@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('body')
    <table>
            <tr>
                <td>Created at </td>
                <td> {{ $class->created_at }} </td>
            </tr>
            <tr>
                <td>Last update </td>
                <td> {{ $class->updated_at }} </td>
            </tr>
            <tr>
                <td>{{$school_name}}</td>
                <td>{{$school_city}}</td>
                <td>{{$canton}}</td>
            </tr>
            <tr>
                <td>Scollar year</td>
                <td>{{$class->scollaryear}}</td>
            </tr>
            <tr>
                <td>Degree</td>
                <td>{{$class->degree}}</td>
            </tr>
            <tr>
                <td>Domain</td>
                <td>{{$class->domain}}</td>
            </tr>
            <tr>
                <td>Visibility</td>
                <td>{{$class->visibility}}</td>
            </tr>
            <tr>
                <td>
                @if(Auth::check() && Auth::user()->userCanAddCourse())
                    {{ Form::open(array('route' => array('/courses/create/{idclass}', 'idclass' => $class->id),'method' => 'get')); }}
                        {{ Form::submit('New Course', array('class' => 'button')) }}
                    {{Form::close();}}
                @endif
                </td>
            </tr>
        </table>
    @yield('display')
@stop