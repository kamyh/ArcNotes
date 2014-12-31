@extends('layouts.default')
@section('title')
    Class Manager
@endsection
@section('body')


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
                {{Form::submit('Invite', array('class' => 'button'))}}
                </td></tr>
            {{ Form::close() }}
        </table>

        <div class="list-classes">
        @foreach($classesOwned as $class)
            <div class="class-tile color-a">
            @if($class != null)
                    <a href="/class/display/{{$class->id}}" class="class-title-tile color-b" >Class Name: {{ $class->name  }} </a>
                <div class="class-tile-buttons">
                <table>
                    {{ Form::open(array('route' => array('/visibility/change/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                    <td>
                        @if($class->visibility == 'public')
                            {{Form::submit('Make Private', array('class' => 'button'))}}
                        @else
                            {{Form::submit('Make Public', array('class' => 'button'))}}
                        @endif
                    {{ Form::close() }}
                       </td><td>
                    {{ Form::open(array('route' => array('/class/remove/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                        {{Form::submit('Delete', array('class' => 'button'))}}
                    {{ Form::close() }}</td>

                </tr>
                </table>
                </div>
                <div class="class-tile-user-title color-b">Users</div>
                <div class="class-tile-user">

                @foreach($class->getUsers() as $user)

                    <table>
                        <tr>
                            {{ $user->firstname }} {{ $user->lastname }}
                        </tr>
                        @if($user->getUserPermForClass($class->id) < 1)
                            <tr><td>
                            {{ Form::open(array('route' => array('/class/accept/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                                {{Form::submit('Accept', array('class' => 'button'))}}
                            {{ Form::close() }}
                            </td>
                            <td>
                            {{ Form::open(array('route' => array('/class/refuse/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                                {{Form::submit('Refuse', array('class' => 'button'))}}
                            {{ Form::close() }}
                            </td></tr>
                        @elseif($user->getUserPermForClass($class->id) != 15)
                            <tr><td>
                            {{ Form::open(array('route' => array('/member/remove/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                                <!--{{Form::submit('Remove', array('class' => 'button'))}}-->
                                    <button type="submit" class="button-image">{{ HTML::image('img/icons/delete.png', 'Remove', array('class' => 'test-image')); }}</button>
                            {{ Form::close() }}
                            </td></tr>

                            {{ Form::open(array('route' => array('/rights/change/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}

                            <table style="border: 1px solid #ffffff">
                                {{-- comment hack to set a variable (otherwise should use de ?php tag): --}}
                                {{--*/ $permissionsTab = $class->getPermissionsTab($user->id) /*--}}
                                <tr>
                                    <td>
                                    {{Form::checkbox('read', '4',$permissionsTab['read'])}}
                                    {{Form::label('read','Read')}}
                                    </td>
                                </tr><tr>
                                    <td>
                                    {{Form::checkbox('edition', '2',$permissionsTab['edit'])}}
                                    {{Form::label('edition','Edition')}}
                                    </td>
                                </tr><tr>
                                    <td>
                                    {{Form::checkbox('creation', '1',$permissionsTab['create'])}}
                                    {{Form::label('creation','Création')}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    {{Form::submit('Validate', array('class' => 'button'))}}
                                    </td>
                                </tr>
                            </table>
                                {{ Form::close() }}
                    @endif
                    </table>
                @endforeach
                </div>
                <div class="class-tile-course-title color-b">Courses</div>
                <div class="class-tile-course">

                @foreach($class->getCourses() as $course)
                    @if($course != null)
                        <table>
                            <tr>
                                {{ $course->name }}
                            </tr>
                            <tr>
                                {{ Form::open(array('route' => array('/course/remove/{idcourse}','idcourse'=>$course->id), 'method' => 'get')) }}
                                    {{--{{Form::submit('Remove', array('class' => 'button'))}}--}}
                                    <button type="submit" class="button-image">{{ HTML::image('img/icons/delete.png', 'Remove', array('class' => 'test-image')); }}</button>
                                {{ Form::close() }}
                            </tr>
                        </table>
                    @endif
                @endforeach
                </div>
            @endif
            </div>
        @endforeach
        </div>
@stop




















