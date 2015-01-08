@extends('...layouts.default')

@section('title')
    Edit Class
@endsection
@section('body')
<div class="class-creation-form color-a">
        <div>
        <table class="color-a">
            {{ Form::open(array('route' => array('classes/update'), 'method' => 'post')) }}
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
                    {{Form::label('name','Name',array('class' => 'label-form'))}}
                </td>
                <td>
                    {{Form::text('name', $class->name,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('school','School',array('class' => 'label-form'))}}
                </td>
                <td>
                    {{ Form::select('school', $schoolList, $class->id_school, array('class' => 'select')) }}

                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('degree','Degree',array('class' => 'label-form'))}}
                </td>
                <td>
                {{Form::text('degree', $class->degree,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('scollaryear','Scholar Year',array('class' => 'label-form'))}}
                </td>
                <td>
                {{ Form::select('scollaryear', $schollarYears, $class->scollaryear, array('class' => '')) }}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('domain','Domain',array('class' => 'label-form'))}}
                </td>
                <td>
                {{Form::text('domain', $class->domain,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('visibility','Visibility',array('class' => 'label-form'))}}
                </td>
                <td>
                {{ Form::select('visibility', $visibilityList, $class->visibility, array('class' => '')) }}
                </td>
            </tr>
            <tr>
                <td>
                {{ Form::hidden('id', $class->id) }}
                {{Form::submit('Save', array('class' => 'button'))}}
                </td>
            </tr>
            {{ Form::close() }}
        </table>
</div></div>
@stop

