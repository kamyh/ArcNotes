@extends('layouts.default')
@section('title')
            {{{$title}}}
@endsection
@section('body')
    <div class ="class-creation-form color-a">
    <table class="color-a">
            <tr>
                <td>Created at </td>
                <td> {{{ $class->created_at }}} </td>
            </tr>
            <tr>
                <td>{{{$school_name}}}</td>
                <td>{{{$school_city." - ".$canton}}}</td>
            </tr>
            <tr>
                <td>Scholar year</td>
                <td>{{{$class->scollaryear}}}</td>
            </tr>
            <tr>
                <td>Degree</td>
                <td>{{{$class->degree}}}</td>
            </tr>
            <tr>
                <td>Domain</td>
                <td>{{{$class->domain}}}</td>
            </tr>
            <tr>
                <td>Visibility</td>
                <td>{{{$class->getVisibilityStr()}}}</td>
            </tr>

                @if($class->isNotIn())
                <tr>
                    <td></td>
                    <td>
                        {{ Form::open(array('route' => array('/classes/sign/{idclass}','idclass'=>$class->id),'method' => 'get')); }}
                            {{Form::submit('Join', array('class' => 'button'))}}
                        {{Form::close();}}
                    </td>
                </tr>
                @endif
        </table>
    </div>
    <div class="course-title">
        <table class="color-b">
            <tr><td>
                    <h2>Courses in {{{$class->name}}}</h2>
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