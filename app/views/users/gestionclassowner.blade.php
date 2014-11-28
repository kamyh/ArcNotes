@extends('layouts.default')
@section('body')

        <?php
        //TODO Replace hidden input for user id by Auth::id()
            echo "test";
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
        <table>
            {{ Form::open(array('route' => array('/class/invite'), 'method' => 'post')) }}
                <tr><td>
                {{Form::label('email','User E-mail Adresse')}}
                {{Form::text('email', null,array('class' => ''))}}
                </td><td>
                {{Form::label('class','Classes')}}
                {{ Form::select('class', $listClasses, null, array('class' => '')) }}
                </td></tr>
                <tr><td>
                {{Form::submit('Invite', array('class' => ''))}}
                </td></tr>
            {{ Form::close() }}
        </table>
        @foreach($classesOwned as $classOwned)

            <?php
                $idClass = $classOwned->id_class;
                $class = DB::table('classes')->where('id','=',$idClass)->first();
            ?>
            @if($class != null)
                <table>

                    <tr><td><h1> Class Name: {{ $class->name  }} </h1></td>

                    {{ Form::open(array('route' => array('/visibility/change'), 'method' => 'post')) }}
                    <td>
                        @if($class->visibility == 'public')
                            {{Form::submit('Make Private', array('class' => ''))}}
                        @else
                            {{Form::submit('Make Public', array('class' => ''))}}
                        @endif

                        {{ Form::hidden('id_class', $idClass) }}
                    {{ Form::close() }}
                    {{ Form::open(array('route' => array('/class/remove'), 'method' => 'post')) }}
                        {{Form::submit('Delete', array('class' => ''))}}</td>
                        {{ Form::hidden('id_class', $idClass) }}
                    {{ Form::close() }}

                </tr>
                </table>
                <?php
                    $userOfTheClass = DB::table('permissions')->where('id_class','=',$idClass)->where('id_rights','!=',15)->get();
                ?>

                <h2>Users</h2>

                @foreach($userOfTheClass as $userIDSeeker)
                    <?php
                        $idUser = $userIDSeeker->id_user;
                        $user = DB::table('users')->where('id','=',$idUser)->first();
                    ?>
                    <table>
                    <tr>
                        {{ $user->firstname }} {{ $user->lastname }}
                    </tr>
                    @if($userIDSeeker->id_rights < 1)
                        <tr><td>
                        {{ Form::open(array('route' => array('/class/accept'), 'method' => 'post')) }}
                            {{Form::submit('Accept', array('class' => ''))}}
                            {{ Form::hidden('id_user', $userIDSeeker->id_user) }}
                            {{ Form::hidden('id_class', $idClass) }}
                        {{ Form::close() }}
                        </td>
                        <td>
                        {{ Form::open(array('route' => array('/class/refuse'), 'method' => 'post')) }}
                            {{Form::submit('Refuse', array('class' => ''))}}
                            {{ Form::hidden('id_user', $userIDSeeker->id_user) }}
                            {{ Form::hidden('id_class', $idClass) }}
                        {{ Form::close() }}
                        </td></tr>
                    @elseif($userIDSeeker->id_rights != 15)
                        <tr><td>
                        {{ Form::open(array('route' => array('/member/remove'), 'method' => 'post')) }}
                            {{ Form::hidden('id_user', $userIDSeeker->id_user) }}
                            {{ Form::hidden('id_class', $idClass) }}
                            {{Form::submit('Remove', array('class' => ''))}}
                        {{ Form::close() }}
                        </td></tr>
                        <div>
                        {{ Form::open(array('route' => array('/rights/change'), 'method' => 'post')) }}
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
                        </table>
                        <table style="border: 1px solid #ffffff">
                        <tr>
                            <td>
                            {{Form::checkbox('read', '4',$isCheckRead)}}
                            {{Form::label('read','Read')}}
                            </td>
                        </tr><tr>
                            <td>
                            {{Form::checkbox('edition', '2',$isCheckEdition)}}
                            {{Form::label('edition','Edition')}}
                            </td>
                        </tr><tr>
                            <td>
                            {{Form::checkbox('creation', '1',$isCheckCreation)}}
                            {{Form::label('creation','Création')}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            {{Form::submit('Validate', array('class' => ''))}}
                            {{ Form::hidden('id_user', $userIDSeeker->id_user) }}
                            {{ Form::hidden('id_class', $idClass) }}
                            </td>
                        </tr>
                        {{ Form::close() }}
                        </div>
                    @endif
                    </table>
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
                        <table>
                            <tr>
                                {{ $course->name }}
                            </tr>
                            <tr>
                                {{ Form::open(array('route' => array('/course/remove'), 'method' => 'post')) }}
                                    {{ Form::hidden('id_course', $courseSeeker->id_course) }}
                                    {{Form::submit('Remove', array('class' => ''))}}
                                {{ Form::close() }}
                            </tr>
                        </table>
                    @endif
                @endforeach
            @endif
        @endforeach
@stop




















