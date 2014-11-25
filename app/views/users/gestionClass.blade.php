@extends('layouts.default')
@section('body')
    <?php
        $classesOwned = DB::table('permissions')->where('id_user','=',Session::get('id'))->where('id_rights','=',15)->get(); //TODO chck if removable

        $classID = DB::table('permissions')->where('id_user','=',Session::get('id'))->where('id_rights','=',15)->lists('id_class');
        $listClasses = DB::table('classes')->whereIn('id',$classID)->lists('id','name');

        var_dump($listClasses);
    ?>

    {{ Form::open(array('route' => array('invite_member'), 'method' => 'post')) }}
        {{Form::label('email','User E-mail Adresse')}}
        {{Form::text('email', null,array('class' => ''))}}
        <br/>
        {{Form::label('class','Classes')}}
        {{ Form::select('class', [], null, array('class' => '')) }}
        <br/>
        {{Form::submit('Invite', array('class' => ''))}}
    {{ Form::close() }}

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
                {{ Form::open(array('route' => array('remove_member'), 'method' => 'post')) }}
                    {{ Form::hidden('id_user', $userIDSeeker->id_user) }}
                    {{ Form::hidden('id_class', $idClass) }}
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

            @if($course != null)
                {{ $course->name }}
                {{ Form::open(array('route' => array('remove_course'), 'method' => 'post')) }}
                    {{ Form::hidden('id_course', $courseSeeker->id_course) }}
                    {{Form::submit('Remove', array('class' => ''))}}
                {{ Form::close() }}
                </br>
            @endif

        @endforeach
    @endforeach
@stop




















