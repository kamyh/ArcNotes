@extends('...layouts.default')
@section('body')

        <?php
            $classID = DB::table('permissions')->where('id_user','=',Auth::id())->where('id_rights','<',15)->lists('id_class');
        ?>
        @if($classID != null)

            <?php
            $listClasses = DB::table('classes')->whereIn('id',$classID)->get();
            ?>

            @foreach($listClasses as $class)
                <table>
                    <tr>
                    <td>
                        <h1>{{$class->name}}</h1>
                    </td>
                    <td>
                        {{ Form::open(array('route' => array('/class/resign'), 'method' => 'post')) }}
                            {{Form::submit('Resign', array('class' => ''))}}
                            {{ Form::hidden('id_class', $class->id) }}
                        {{ Form::close() }}
                    </td>
                    </tr>

                        <?php
                            $listCourses = DB::table('assocclasscourse')->where('id_class','=',$class->id);
                        ?>
                        @if($listCourses->count() > 0)
                            <?php
                                $courses = DB::table('courses')->whereIn('id',$listCourses->lists('id_course'))->get();
                            ?>
                            @foreach($courses as $course)
                                <tr>
                                    <td>
                                        {{$course->name}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                @endforeach
        @endif
@stop
