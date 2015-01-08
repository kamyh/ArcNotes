@extends('...layouts.default')
@section('title')
    Create a new course
@endsection
@section('body')
<div class="">
        <div class="class-creation-form color-a">
        <table>
            {{ Form::open(array('route' => array('courses.store'), 'method' => 'post')) }}
            @if($errors->has())
            <tr>
                <td colspan="2">
                @foreach ($errors->all() as $error)
                   <div class="error">{{{ $error }}}</div>
                @endforeach
                </td>
           </tr>
           @endif
            <tr>
                <td>
                    {{Form::label('name','Name')}}
                </td>
                <td>
                    {{Form::text('name', null,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                    {{Form::label('matter','Matter')}}
                </td>
                <td>
                    {{Form::text('matter', null,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                {{ Form::hidden('idclass', $idclass) }}
                {{Form::submit('Create', array('class' => 'button'))}}
                </td>
            </tr>
            {{ Form::close() }}
        </table>
        </div>
</div>
@stop
