@extends('layouts.default')
@section('body')
<div class="">
        <?php

        $orderOptionList = ['name','scollaryear','domain','degree'];

        switch(Session::get('orderOption'))
        {
            case 0:
            {
                $orderOption = 'name';
                break;
            }
            case 1:
            {
                $orderOption = 'scollaryear';
                break;
            }
            case 2:
            {
                $orderOption = 'domain';
                break;
            }
            case 3:
            {
                $orderOption = 'degree';
                break;
            }
            case 4:
            {
                $orderOption = 'school';
                break;
            }
            default:
            {
                $orderOption = 'name';
            }
        }

        $yourClass = DB::table('permissions')->where('id_user','=',Auth::id())->lists('id_class');

        $classesList = DB::table('classes')->whereNotIn('id',$yourClass)->orderBy($orderOption, 'DESC')->get();

        //TODO MODIFICATION --> display by table with search field filter
        ?>

        <h2>Classes</h2>
        <?php //TODO FINISH/DEBUG?>
        <table>
            <tr>
                {{ Form::open(array('route' => array('signclass'), 'method' => 'post')) }}
                <td>
                    {{Form::label('orderOption','Order By')}}
                </td>
                <td>
                    {{ Form::select('orderOption', $orderOptionList, Session::get('orderOption'), array('class' => 'orderOptionClass' , 'id' => 'orderOptionID')) }}
                </td>
                </tr>
                <tr>
                    <td>
                        {{Form::submit('Validate', array('class' => ''))}}
                    </td>
            </tr>
            {{ Form::close() }}
        </table>

        @foreach($classesList as $class)
            @if($class->visibility == 'public')
                <?php
                    $id_school = $class->id_school;
                    $school = DB::table('schools')->where('id','=',$id_school)->first();

                    $id_location = $school->id_location;
                    $location = DB::table('cities')->where('id','=',$id_location)->first();

                    $id_canton = $location->id_canton;
                    $canton = DB::table('cantons')->where('id','=',$id_canton)->first();
                ?>
                </br>
                <table style="border: 1px solid #ffffff">
                    <tr>
                        <td>
                            Name
                            </td><td>
                            {{ $class->name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Scollar year
                        </td><td>
                        {{ $class->scollaryear }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Domain
                        </td><td>
                        {{ $class->domain }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Degree
                        </td><td>
                        {{ $class->degree }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        School
                        </td><td>
                        {{ $school->name }} - {{$location->name}} - {{$canton->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>Visibility</td>
                        <td>{{$class->visibility}}</td>
                    </tr>
                    <tr>
                        <td>
                        {{ Form::open(array('route' => array('joinclass'), 'method' => 'post')) }}
                            {{ Form::hidden('id', $class->id) }}
                            {{Form::submit('Join', array('class' => ''))}}
                        </td>
                    </tr>
                    {{ Form::close() }}
                </table>

            @endif
        @endforeach
</div>
@stop
