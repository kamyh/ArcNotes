@extends('layouts.default')
@section('body')
<div class="">
        <?php
        //TODO TEST
        echo Session::get('isLogged');

        $orderOptionList = ['name','scollaryear','domain','degree','school'];

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

        $classesList = DB::table('classes')->orderBy($orderOption, 'DESC')->get();

        //TODO MODIFICATION --> display by table with search field filter
        ?>

        <h2>Classes</h2>

        {{ Form::open(array('route' => array('signclass'), 'method' => 'post')) }}
            {{Form::label('orderOption','Order By')}}
            {{ Form::select('orderOption', $orderOptionList, Session::get('orderOption'), array('class' => 'orderOptionClass' , 'id' => 'orderOptionID')) }}

            {{Form::submit('Validate', array('class' => ''))}}
        {{ Form::close() }}
        <br/>


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

                <p>Name:  {{ $class->name }}</p>
                <p>Scollar year:  {{ $class->scollaryear }}</p>
                <p>Domain:  {{ $class->domain }}</p>
                <p>Degree:  {{ $class->degree }}</p>
                <p>School:  {{ $school->name }} - {{$location->name}} - {{$canton->name}}</p>



                {{ Form::open(array('route' => array('joinclass'), 'method' => 'post')) }}

                    {{ Form::hidden('id', $class->id) }}
                    {{Form::submit('Join', array('class' => ''))}}
                {{ Form::close() }}

            @endif
        @endforeach


</div>
@stop
