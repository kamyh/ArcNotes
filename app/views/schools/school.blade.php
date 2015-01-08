@extends('...layouts.default')
@section('title')
    New School
@endsection
@section('body')

<div class="class-creation-form color-a">
        <table>
            {{ Form::open(array('route' => array('/schools/create'), 'method' => 'post')) }}
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
                {{Form::label('name_school','Name')}}
                </td>
                <td>
                {{Form::text('name_school', null,array('class' => ''))}}
                </td>
            </tr>

            <tr>
                <td>
                {{Form::label('city','City')}}
                </td><td>
                {{ Form::select('city', (new Cities())->getList(), null, array('class' => 'select', 'id' => 'selectCities')) }}
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


