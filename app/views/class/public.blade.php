@extends('layouts.default')
@section('body')
    <table>
        <tr>
            <td>Public Classes</td>
        </tr>
        @foreach($classes_public as $class)
            <tr>
                <td><h2><div onClick='location.href="/class/open/{{$class->id}}"' class="header-menu-tile color-b hover-color-a">{{$class->name}}</div></h2></td>
            </tr>
            <tr>
                <td>Created at </td>
                <td> {{ $class->created_at }} </td>
            </tr>
            <tr>
                <td>Last update </td>
                <td> {{ $class->updated_at }} </td>
            </tr>
            <tr>
                <td>{{$class->getSchoolName()}}</td>
                <td>{{$class->getCitie()}}</td>
                <td>{{$class->getCanton()}}</td>
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
                    {{ Form::open(array('route' => array(''), 'method' => 'post')) }}
                        {{Form::submit('Register', array('class' => ''))}}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
    </table>
@stop