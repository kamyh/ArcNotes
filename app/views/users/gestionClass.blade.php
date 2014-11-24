@extends('layouts.default')
@section('body')
    <?php
        $classesOwned = DB::table('permissions')->where('id_user','=',Session::get('id'))->where('id_rights','=',15)->get();
    ?>

    @foreach($classesOwned as $classOwned)

        <?php
            $idClass = $classOwned->id_class;
            $class = DB::table('classes')->where('id','=',$idClass)->first();
        ?>
        <h1>
            Class Name: {{ $class->name  }}
        </h1>

        <?php
            $userOfTheClass = DB::table('permissions')->where('id_class','=',$idClass)->where('id_rights','!=',15)->get();
        ?>

        <h2>Users</h2>

        @foreach($userOfTheClass as $userIDSeeker)
            <?php
                $idUser = $userIDSeeker->id_user;
                $user = DB::table('users')->where('id','=',$idUser)->first();

            ?>



            {{ $user->firstname }} {{ $user->lastname }}

            @if($userIDSeeker->id_rights < 1)
                {{ Form::open(array('route' => array('accept_member'), 'method' => 'post')) }}
                    {{Form::submit('Accept', array('class' => ''))}}
                    {{ Form::hidden('id_user', $userIDSeeker->id_user) }}
                    {{ Form::hidden('id_class', $idClass) }}
                {{ Form::close() }}
            @elseif($userIDSeeker->id_rights != 15)
                {{ Form::open(array('route' => array('signclass'), 'method' => 'post')) }}
                    {{Form::submit('Remove', array('class' => ''))}}
                {{ Form::close() }}
                {{ Form::open(array('route' => array('signclass'), 'method' => 'post')) }}
                    <!-- TODO chkBox rights -->
                    {{Form::submit('Validate', array('class' => ''))}}
                {{ Form::close() }}
            @endif
        @endforeach



        <h2>Courses</h2>

        <?php
            $coursesOfClass = DB::table('assocclasscourse')->where('id_class','=',$idClass)->get();
        ?>

        @foreach($coursesOfClass as $courseSeeker)

            <?php
                $idCourse = $courseSeeker->id_course;
                $course = DB::table('courses')->where('id','=',$idCourse)->first();
            ?>

            {{ $course->name }}
            {{ Form::open(array('route' => array('signclass'), 'method' => 'post')) }} <!-- TODO route to create -->
                {{Form::submit('Remove', array('class' => ''))}}
            {{ Form::close() }}
            </br>

        @endforeach
    @endforeach
@stop




















