@extends('...layouts.default')
@section('title')
    Class Manager
@endsection
@section('body')


        <div class="list-classes">

        @if(count($classesOwned))
        @foreach($classesOwned as $class)
            <div class="class-tile color-a" id="{{$class->id}}" >

            @if($class != null)
                <table class="class-title-tile color-b">
                    <tr>
                        <td><a href="/classes/display/{{$class->id}}" class="class-title-tile color-b" >{{ $class->name  }} </a></td>
                        <td>
                            {{ Form::open(array('route' => array('/classes/edit/{idClass}','idClass'=>$class->id), 'method' => 'get')) }}
                               <button type="submit" class="button-image">{{ HTML::image('img/icons/edit.png', 'Accept', array('class' => 'test-image')); }}</button>
                            {{ Form::close() }}
                        </td>
                    </tr>
                </table>
                    @if($errors->any())
                        @if(Session::has('errorOrigine') && Session::get('errorOrigine') == $class->id)
                            <div class="">
                                <a class="error-msg" data-dismiss="alert">&times;</a>
                                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                            <br/>
                            </div>
                        @endif
                    @endif
                <div class="class-tile-buttons">

                    <div>

                    {{ Form::open(array('route' => array('/classes/visibility/change/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}

                        @if($class->visibility == 1) <!-- 1 = public -->
                            {{Form::submit('Make Private', array('class' => 'button'))}}
                        @else
                            {{Form::submit('Make Public', array('class' => 'button'))}}
                        @endif
                    {{ Form::close() }}
                    </div>
                    <div>
                    {{ Form::open(array('route' => array('/classes/remove/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                        {{Form::submit('Delete', array('class' => 'button'))}}
                    {{ Form::close() }}
                    </div>
                </div>
                <div class="class-tile-user-title color-b">Pending Users</div>
                <div class="class-tile-users">

                @foreach($class->getUsers() as $user)
                    <div>
                    <table>
                        <tr>


                        @if($user->getUserPermForClass($class->id) < 1)
                            <td>{{ $user->firstname }} {{ $user->lastname }} </td>

                            <td>
                            {{ Form::open(array('route' => array('/classes/member/accept/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                               <button type="submit" class="button-image">{{ HTML::image('img/icons/accept.png', 'Accept', array('class' => 'test-image')); }}</button>
                            {{ Form::close() }}
                            </td>
                            <td>
                            {{ Form::open(array('route' => array('/classes/member/refuse/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                               <!-- {{Form::submit('Decline', array('class' => 'button'))}}-->
                               <button type="submit" class="button-image">{{ HTML::image('img/icons/delete.png', 'Refuse', array('class' => 'test-image')); }}</button>
                            {{ Form::close() }}
                            </td></tr>
                        @endif
                    </table>
                    </div>
                @endforeach
                </div>

                 <div class="class-tile-user-title color-b">Users</div>
                 <div class="class-tile-users">

                @foreach($class->getUsers() as $user)
                     <div>
                     <table>
                         <tr>
                        @if($user->getUserPermForClass($class->id) != 15 && $user->getUserPermForClass($class->id) > 1)
                        <td>{{ $user->firstname }} {{ $user->lastname }} </td>

                            <td>
                            {{ Form::open(array('route' => array('/classes/member/remove/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                                <!--{{Form::submit('Remove', array('class' => 'button'))}}-->
                                    <button type="submit" class="button-image">{{ HTML::image('img/icons/delete.png', 'Remove', array('class' => 'test-image')); }}</button>
                            {{ Form::close() }}
                            </td></tr>

                            {{ Form::open(array('route' => array('/classes/rights/change/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}

                            <table class="form-table">
                                {{-- comment hack to set a variable (otherwise should use the
                                 ?php tag): --}}
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
                                    {{Form::label('creation','Creation')}}
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
                    </div>
                @endforeach
                </div>
                <div class="class-tile-course-title color-b">
                    <table>
                        <tr>
                            <td>
                                Courses
                            </td>
                            <td>
                                {{ Form::open(array('route' => array('/courses/create/{idclass}', 'idclass' => $class->id),'method' => 'get')); }}
                                    <button type="submit" class="button-image" title="Create a course">{{ HTML::image('img/icons/plus.png', 'Invite', array('class' => 'test-image')); }}</button>
                                {{Form::close();}}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="class-tile-courses">

                @foreach($class->getCourses() as $course)
                    @if($course != null)
                    <div>
                        <table>
                            <tr>
                                <td>
                                {{ $course->name }}
                                </td>
                                <td>
                                    {{ Form::open(array('route' => array('/courses/remove/{idcourse}','idcourse'=>$course->id), 'method' => 'get')) }}
                                        <button type="submit" class="button-image">{{ HTML::image('img/icons/delete.png', 'Remove', array('class' => 'test-image')); }}</button>
                                    {{ Form::close() }}
                                </td>
                                <td>
                                    {{ Form::open(array('route' => array('/courses/edit/{idclass}/{idcourse}','idclass'=>$class->id,'idcourse'=>$course->id), 'method' => 'get')) }}
                                        <button type="submit" class="button-image">{{ HTML::image('img/icons/edit.png', 'Remove', array('class' => 'test-image')); }}</button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        </table>
                        </div>
                    @endif
                @endforeach
                </div>

                <div class="class-tile-course-title color-b">Invite someone</div>
                <div class="class-tile-invite">

            <table>
            {{ Form::open(array('route' => array('/classes/member/invite'), 'method' => 'post')) }}
                <tr>
                <td>
                {{Form::label('email','e-mail')}}</td><td>
                {{Form::text('email', null,array('class' => ''))}}</td><td>
                {{ Form::hidden('class', $class->id) }}
                <button type="submit" class="button-image">{{ HTML::image('img/icons/plus.png', 'Invite', array('class' => 'test-image')); }}</button>
               </td> </tr>
            {{ Form::close() }}
            </table>
                </div>

            @endif
            </div>

        @endforeach
        @else
           <div class="class-creation-form color-a">No classes owned.</div>
        @endif
        </div>
@stop
