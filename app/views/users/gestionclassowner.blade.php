@extends('layouts.default')
@section('body')

    @if(Session::get('isLogged') == 1)
        <?php
            $classesOwned = DB::table('permissions')->where('id_user','=',Session::get('id'))->where('id_rights','=',15)->get(); //TODO chck if removable

            $classID = DB::table('permissions')->where('id_user','=',Session::get('id'))->where('id_rights','=',15)->lists('id_class');
            $listClasses = DB::table('classes')->whereIn('id',$classID)->lists('name','id');
        ?>
        @if($errors->any())
            <div class="">
                <a class="error-msg" data-dismiss="alert">&times;</a>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </div>
        @endif
        {{ Form::open(array('route' => array('invite_member'), 'method' => 'post')) }}
            {{Form::label('email','User E-mail Adresse')}}
            {{Form::text('email', null,array('class' => ''))}}
            <br/>
            {{Form::label('class','Classes')}}
            {{ Form::select('class', $listClasses, null, array('class' => '')) }}
            <br/>
            {{Form::submit('Invite', array('class' => ''))}}
        {{ Form::close() }}

        @foreach($classesOwned as $classOwned)

            <?php
                $idClass = $classOwned->id_class;
                $class = DB::table('classes')->where('id','=',$idClass)->first();
            ?>
            @if($class != null)
                <h1>
                    Class Name: {{ $class->name  }}
                    {{ Form::open(array('route' => array('chgt_visibility'), 'method' => 'post')) }}
                        @if($class->visibility == 'public')
                            {{Form::submit('Make Private', array('class' => ''))}}
                        @else
                            {{Form::submit('Make Public', array('class' => ''))}}
                        @endif
                        {{ Form::hidden('id_class', $idClass) }}
                    {{ Form::close() }}
                    {{ Form::open(array('route' => array('remove_class'), 'method' => 'post')) }}
                        {{Form::submit('Delete', array('class' => ''))}}
                        {{ Form::hidden('id_class', $idClass) }}
                    {{ Form::close() }}
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
                        {{ Form::open(array('route' => array('refuse_member'), 'method' => 'post')) }}
                            {{Form::submit('Refuse', array('class' => ''))}}
                            {{ Form::hidden('id_user', $userIDSeeker->id_user) }}
                            {{ Form::hidden('id_class', $idClass) }}
                        {{ Form::close() }}
                    @elseif($userIDSeeker->id_rights != 15)
                        {{ Form::open(array('route' => array('remove_member'), 'method' => 'post')) }}
                            {{ Form::hidden('id_user', $userIDSeeker->id_user) }}
                            {{ Form::hidden('id_class', $idClass) }}
                            {{Form::submit('Remove', array('class' => ''))}}
                        {{ Form::close() }}

                        {{ Form::open(array('route' => array('chgt_rights'), 'method' => 'post')) }}
                            <?php
                            $perm = DB::table('permissions')->where('id_user','=',$userIDSeeker->id_user)->where('id_class','=',$idClass)->first();

                            $isCheckRead = 0;
                            $isCheckEdition = 0;
                            $isCheckCreation = 0;

                            if(($perm->id_rights & 4) != 0)
                            {
                                 $isCheckRead = true;
                            }
                            if(($perm->id_rights & 2) != 0)
                            {
                                 $isCheckEdition = true;
                            }
                            if(($perm->id_rights & 1) != 0)
                            {
                                 $isCheckCreation = true;
                            }

                            ?>

                            {{Form::checkbox('read', '4',$isCheckRead)}}
                            {{Form::label('read','Read')}}
                            <br/>
                            {{Form::checkbox('edition', '2',$isCheckEdition)}}
                            {{Form::label('edition','Edition')}}
                            <br/>
                            {{Form::checkbox('creation', '1',$isCheckCreation)}}
                            {{Form::label('creation','Création/Suppression')}}
                            <br/>
                            {{Form::submit('Validate', array('class' => ''))}}
                            {{ Form::hidden('id_user', $userIDSeeker->id_user) }}
                            {{ Form::hidden('id_class', $idClass) }}
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
            @endif
        @endforeach
    @endif
@stop




















