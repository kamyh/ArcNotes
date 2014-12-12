@extends('layouts.default')
@section('title')
    Create a new course
@endsection
@section('body')
<div class="">
        <h2>new course</h2>
        <?php
            $schoolList = DB::table('courses')->lists('name','id');
        ?>
        <table>
            {{ Form::open(array('route' => array('courses.store'), 'method' => 'post')) }}
            @if($errors->any())
                <tr>
                    <td>
                        <div class="">
                            <a class="" data-dismiss="alert">&times;</a>
                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                        </div>
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
@stop
