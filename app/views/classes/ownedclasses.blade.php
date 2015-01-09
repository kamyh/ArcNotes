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
                               <button type="submit" title="Edit class" class="button-image">{{ HTML::image('img/icons/edit.png', 'Accept', array('class' => 'test-image')); }}</button>
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

                    <table>
                        <tr>
                            <td>
                                {{ Form::open(array('route' => array('/classes/visibility/change/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                                        @if($class->visibility == 1) <!-- 1 = public -->
                                            {{Form::submit('Make Private', array('class' => 'button','title' => 'Make private'))}}
                                        @else
                                            {{Form::submit('Make Public', array('class' => 'button','title' => 'Make public'))}}
                                        @endif
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(array('route' => array('/classes/remove/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                                    {{Form::submit('Delete', array('class' => 'button', 'title' => 'Delete class'))}}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="class-tile-user-title color-b">Pending Users</div>
                <div class="class-tile-users">

                @foreach($class->getUsers() as $user)
                    <div>
                    <table>
                        <tr>


                        @if($user->getUserPermForClass($class->id) < 1)
                            <td class="color-a">{{ $user->firstname }} {{ $user->lastname }} </td>

                            <td>
                            {{ Form::open(array('route' => array('/classes/member/accept/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                               <button type="submit" class="button-image" title="Accept user">{{ HTML::image('img/icons/accept.png', 'Accept', array('class' => 'test-image')); }}</button>
                            {{ Form::close() }}
                            </td>
                            <td>
                            {{ Form::open(array('route' => array('/classes/member/refuse/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                               <!-- {{Form::submit('Decline', array('class' => 'button'))}}-->
                               <button type="submit" class="button-image" title="Refuse user">{{ HTML::image('img/icons/delete.png', 'Refuse', array('class' => 'test-image')); }}</button>
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
                        <td class="color-a">{{ $user->firstname }} {{ $user->lastname }} </td>

                            <td>
                            {{ Form::open(array('route' => array('/classes/member/remove/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}
                                <!--{{Form::submit('Remove', array('class' => 'button'))}}-->
                                    <button type="submit" class="button-image" title="Remove user">{{ HTML::image('img/icons/delete.png', 'Remove', array('class' => 'test-image')); }}</button>
                            {{ Form::close() }}
                            </td></tr>

                            {{ Form::open(array('route' => array('/classes/rights/change/{iduser}/{idclass}','iduser'=>$user->id,'idclass'=>$class->id), 'method' => 'get')) }}

                            <table class="form-table">
                                {{-- comment hack to set a variable (otherwise should use the
                                 ?php tag): --}}
                                {{--*/ $permissionsTab = $class->getPermissionsTab($user->id) /*--}}
                                <tr>
                                    <td class="color-a">
                                    {{Form::checkbox('read', '4',$permissionsTab['read'])}}
                                    {{Form::label('read','Read')}}
                                    </td>
                                </tr><tr>
                                    <td class="color-a">
                                    {{Form::checkbox('edition', '2',$permissionsTab['edit'])}}
                                    {{Form::label('edition','Edition')}}
                                    </td>
                                </tr><tr>
                                    <td class="color-a">
                                    {{Form::checkbox('creation', '1',$permissionsTab['create'])}}
                                    {{Form::label('creation','Creation')}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    {{Form::submit('Validate', array('class' => 'button','title' => 'Apply rights'))}}
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
                        Courses
                </div>
                <div class="class-tile-courses">

                @foreach($class->getCourses() as $course)
                    @if($course != null)
                    <div>
                        <table class="color-a">
                            <tr>
                                <td>
                                {{ $course->name }}
                                </td>
                                <td>
                                    {{ Form::open(array('route' => array('/courses/remove/{idcourse}','idcourse'=>$course->id), 'method' => 'get')) }}
                                        <button type="submit" class="button-image" title="Delete course">{{ HTML::image('img/icons/delete.png', 'Remove', array('class' => 'test-image')); }}</button>
                                    {{ Form::close() }}
                                </td>
                                <td>
                                    {{ Form::open(array('route' => array('/courses/edit/{idcourse}/{idclass}','idclass'=>$class->id,'idcourse'=>$course->id), 'method' => 'get')) }}
                                        <button type="submit" class="button-image" title="Edit course">{{ HTML::image('img/icons/edit.png', 'Remove', array('class' => 'test-image')); }}</button>
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

            <table class="color-a">
            {{ Form::open(array('route' => array('/classes/member/invite'), 'method' => 'post')) }}
                <tr>
                <td class="color-a">
                {{Form::label('email','e-mail')}}</td><td>
                {{Form::text('email', null,array('class' => ''))}}</td><td>
                {{ Form::hidden('class', $class->id) }}
                <button type="submit" class="button-image" title="Send invite">{{ HTML::image('img/icons/plus.png', 'Invite', array('class' => 'test-image')); }}</button>
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
