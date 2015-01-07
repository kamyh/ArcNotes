<!--
@extends('layouts.default')
@section('title')
    {{ $class[0]->name }}
@endsection
@section('body')
    <div class="class-creation-form color-a">
    <div><table>
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
            <td>Schollar year</td>
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
            <td>{{$class[0]->getVisibilityStr()}}</td>
        </tr>
        <tr>
            <td>
            @if(user::userCanAddCourse())
                {{ Form::open(array('route' => array('/courses/create/{idclass}', 'idclass' => $class[0]->id),'method' => 'get')); }}
                    {{ Form::submit('New Course', array('class' => 'button')) }}
                {{Form::close();}}
            @endif
        </td>
    </tr>
</table>
</div></div>
<div class="all-course">
@foreach($courses as $course)
        <table style="border: solid 1px #ffffff">
            <tr>
                @if (Auth::check())
                <td><div onClick='location.href="/courses/open/{{$course->id}}"'class="context-menu-tile hover-color-a"> {{$course->name}} </div></td>
                @else
        <td><div class="context-menu-tile"> {{$course->name}} </div></td>
                @endif
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

-->