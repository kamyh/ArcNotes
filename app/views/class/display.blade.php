@extends('layouts.default')
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
            <!-- TODO chk id permissions -->
                {{ Form::open(array('route' => array('/courses/create', 'idclass' => $class->id),'method' => 'get')); }}
                    {{ Form::submit('New Course',null, array('class' => 'button')); }}
                {{Form::close();}}
            </td>
        </tr>
    </table>

    <div class="all-course" style="margin-left: 25px">
    @foreach($courses as $course)
        <table style="border: solid 1px #ffffff">
            <tr>

                <td><div onClick='location.href="/cours/open/{{$course->id}}"' class="context-menu-tile hover-color-a"> {{$course->name}} </div></td>
            </tr>
            <tr>
                <td>Created at </td>
                <td>{{$course->created_at}}</td>
            </tr>
            <tr>
                <td>Last update </td>
                <td>{{$course->updated_at}}</td>
            </tr>
            <tr>
                <td>Matter</td>
                <td>{{$course->matter}}</td>
            </tr>
        </table>
    @endforeach
    </div>
@stop
