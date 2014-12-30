@extends('layouts.default')
@section('title')
    New School
@endsection
@section('body')

<div class="">
        <table>
            {{ Form::open(array('route' => array('school.store'), 'method' => 'post')) }}
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
                {{Form::label('canton','Canton')}}
                </td>
                <td>
                {{ Form::select('canton', (new Canton())->getList(), null, array('class' => '' , 'id' => 'selectCanton')) }}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('city','City')}}
                </td><td>
                {{ Form::select('city', (new Cities())->getList(), null, array('class' => '', 'id' => 'selectCities')) }}
                </td>
            </tr>

            @if(isset($input))
                @foreach(array_keys($input) as $key)
                    @if($key != '_token')
                        {{ Form::hidden($key, $input[$key]) }}
                    @endif
                @endforeach
            @endif
            <tr>
                <td>
                {{Form::submit('Create', array('class' => 'button'))}}
                </td>
            </tr>
            {{ Form::close() }}
        </table>
</div>
@stop


