@extends('layouts.default')
@section('body')
<div class="">
        <h2>sign class</h2>
        <?php
        //TODO TEST
        echo Session::get('isLogged');

        $orderOptionList = ['name','scollaryear','domain'];

        if(isset($_SESSION['orderOption']))
        {
            $orderOption = $_SESSION['orderOption'];
        }
        else
        {
            $orderOption = 'name';
        }

        $classesList = DB::table('classes')->orderBy($orderOption, 'DESC')->get();

        //TODO MODIFICATION --> display by table with search field filter
        ?>

        <h2>Classes</h2>

        {{ Form::open(array('route' => array('signclass'), 'method' => 'post')) }}
            {{Form::label('orderOption','Order By')}}
            {{ Form::select('orderOption', $orderOptionList, null, array('class' => 'orderOptionClass' , 'id' => 'orderOptionID')) }}

            {{Form::submit('Validate', array('class' => ''))}}
        {{ Form::close() }}
        <br/>

        <?php
        var_dump($classesList);
        ?>

        @foreach($classesList as $class)

            <p>Name:  {{ $class->name }}</p>



            {{ Form::open(array('route' => array('joinclass'), 'method' => 'post')) }}

                {{ Form::hidden('id', $class->id) }}
                {{Form::submit('Join', array('class' => ''))}}
            {{ Form::close() }}


        @endforeach


</div>
@stop
