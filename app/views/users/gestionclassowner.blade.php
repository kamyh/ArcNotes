@extends('layouts.default')
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
                {{Form::submit('Invite', array('class' => ''))}}
                </td></tr>
            {{ Form::close() }}
        </table>

        @foreach($classesOwned as $class)
            @if($class != null)
                <table>

                    <tr><td><h1> Class Name: {{ $class->name  }} </h1></td>

                    {{ Form::open(array('route' => array('/visibility/change/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                    <td>
                        @if($class->visibility == 'public')
                            {{Form::submit('Make Private', array('class' => ''))}}
                        @else
                            {{Form::submit('Make Public', array('class' => ''))}}
                        @endif

                    {{ Form::close() }}
                    {{ Form::open(array('route' => array('/class/remove/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                        {{Form::submit('Delete', array('class' => ''))}}</td>
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
                                {{Form::submit('Accept', array('class' => ''))}}
                            {{ Form::close() }}
                            </td>
                            <td>
                            {{ Form::open(array('route' => array('/class/refuse/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                                {{Form::submit('Refuse', array('class' => ''))}}
                            {{ Form::close() }}
                            </td></tr>
                        @elseif($user->getUserPermForClass($class->id) != 15)
                            <tr><td>
                            {{ Form::open(array('route' => array('/member/remove/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                                {{Form::submit('Remove', array('class' => ''))}}
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
                                    {{Form::submit('Validate', array('class' => ''))}}
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
                                    {{Form::submit('Remove', array('class' => ''))}}
                                {{ Form::close() }}
                            </tr>
                        </table>
                    @endif
                @endforeach
            @endif
        @endforeach
@stop




















