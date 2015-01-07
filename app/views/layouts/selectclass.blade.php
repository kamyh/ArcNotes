@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('body')
    <div class ="class-creation-form color-a">
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
                <td>Schollar year</td>
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
                <td>{{$class->getVisibilityStr()}}</td>
            </tr>
        </table>
    </div>
    <div class="course-title">
        <table>
            <tr><td>
                    <h2>Courses in {{$class->name}}</h2>
                </td>
                    @if(Auth::check() && $class->canCreate())
                <td>
                        {{ Form::open(array('route' => array('/courses/create/{idclass}', 'idclass' => $class->id),'method' => 'get')); }}
                        <button type="submit" class="button-image" title="Create a course">{{ HTML::image('img/icons/plus.png', 'Invite', array('class' => 'test-image')); }}</button>
                        {{Form::close();}}
                </td></tr>
                    @endif
        </table>
    </div>
    @yield('display')
@stop