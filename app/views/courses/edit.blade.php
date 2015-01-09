@extends('...layouts.default')
@section('title')
    Edit course
@endsection
@section('body')
<div class="">
        <div class="class-creation-form color-a">
        <table class="color-a">
            {{ Form::open(array('route' => array('/courses/update'), 'method' => 'post')) }}
            @if($errors->has())
            <tr>
                <td colspan="2">
                @foreach ($errors->all() as $error)
                   <div class="error">{{ $error }}</div>
                @endforeach
                </td>
           </tr>
           @endif
            <tr>
                <td>
                    {{Form::label('name','Name')}}
                </td>
                <td>
                    {{Form::text('name', $course->name,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                    {{Form::label('matter','Matter')}}
                </td>
                <td>
                    {{Form::text('matter', $course->matter,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                {{ Form::hidden('idclass', $idclass) }}
                {{ Form::hidden('idcourse', $course->id) }}
                {{Form::submit('Save', array('class' => 'button'))}}
                </td>
            </tr>
            {{ Form::close() }}
        </table>
        </div>
</div>
@stop
