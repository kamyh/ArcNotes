@extends('layouts.default')
@section('body')
<div class="">
        <h2>new class</h2>
        <?php
            $schoolList = DB::table('schools')->lists('name','id');
            array_unshift($schoolList, "------------");
            array_unshift($schoolList, "New School");
            $visibilityList =['0000' => 'public','0001' => 'private'];

            if(isset($name))
                echo $name;


        ?>
        <table>
            {{ Form::open(array('route' => array('classes.store'), 'method' => 'post')) }}
            @if($errors->any())
            <tr>
                <div class="">
                    <a class="" data-dismiss="alert">&times;</a>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </div>
            </tr>
            @endif
            <tr>
                <td>
                    {{Form::label('name','Name',array('class' => 'label-form'))}}
                </td>
                <td>
                    {{Form::text('name', null,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('school','School',array('class' => 'label-form'))}}
                </td>
                <td>
                {{ Form::select('school', $schoolList, null, array('class' => '')) }}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('degree','Degree',array('class' => 'label-form'))}}
                </td>
                <td>
                {{Form::text('degree', null,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('scollaryear','Scollar Year',array('class' => 'label-form'))}}
                </td>
                <td>
                {{Form::text('scollaryear', null,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('domain','Domain',array('class' => 'label-form'))}}
                </td>
                <td>
                {{Form::text('domain', null,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('visibility','Visibility',array('class' => 'label-form'))}}
                </td>
                <td>
                {{ Form::select('visibility', $visibilityList, null, array('class' => '')) }}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::submit('Create', array('class' => ''))}}
                </td>
            </tr>
            {{ Form::close() }}
        </table>
</div>
@stop

