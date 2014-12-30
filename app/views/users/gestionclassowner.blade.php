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
                <table>


                    {{ Form::open(array('route' => array('/visibility/change/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                    <td>
                        @if($class->visibility == 'public')
                            {{Form::submit('Make Private', array('class' => 'button'))}}
                        @else
                            {{Form::submit('Make Public', array('class' => 'button'))}}
                        @endif

                    {{ Form::close() }}
                    {{ Form::open(array('route' => array('/class/remove/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                        {{Form::submit('Delete', array('class' => 'button'))}}</td>
                    {{ Form::close() }}

                </tr>
                </table>

                <h2>Users</h2>

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
                                {{Form::submit('Remove', array('class' => 'button'))}}
                            {{ Form::close() }}
                            </td></tr>

                            {{ Form::open(array('route' => array('/rights/change/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}

                            <table style="border: 1px solid #ffffff">
                                <tr>
                                    <td>
                                    {{Form::checkbox('read', '4',$class->getPermissionsTab($user->id)['read'])}}
                                    {{Form::label('read','Read')}}
                                    </td>
                                </tr><tr>
                                    <td>
                                    {{Form::checkbox('edition', '2',$class->getPermissionsTab($user->id)['edit'])}}
                                    {{Form::label('edition','Edition')}}
                                    </td>
                                </tr><tr>
                                    <td>
                                    {{Form::checkbox('creation', '1',$class->getPermissionsTab($user->id)['create'])}}
                                    {{Form::label('creation','Création')}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    {{Form::submit('Validate', array('class' => 'button'))}}
                                    </td>
                                </tr>
                                {{ Form::close() }}
                            </table>
                    @endif
                    </table>
                @endforeach

                <h2>Courses</h2>

                @foreach($class->getCourses() as $course)


                    @if($course != null)
                        <table>
                            <tr>
                                {{ $course->name }}
                            </tr>
                            <tr>
                                {{ Form::open(array('route' => array('/course/remove/{idcourse}','idcourse'=>$course->id), 'method' => 'get')) }}
                                    {{Form::submit('Remove', array('class' => 'button'))}}
                                {{ Form::close() }}
                            </tr>
                        </table>
                    @endif
                @endforeach
            @endif
            </div>
        @endforeach
        </div>
@stop




















