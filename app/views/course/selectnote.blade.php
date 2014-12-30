@extends('layouts.default')
@section('title')
    {{ $course->name }}
@endsection
@section('body')

    <h1> {{ $course->name }}</h1>

    <table style="border: solid 1px #ffffff">
        <tr>
            <td>Created at</td>
            <td>{{$course->created_at}}</td>
        </tr>
        <tr>
            <td>Last update</td>
            <td>{{$course->updated_at}}</td>
        </tr>
        <tr>
            <td>Matter</td>
            <td>{{$course->matter}}</td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
            </td>
        </tr>
    </table>
    <h2>
                {{ Form::open(array('route' => array('/notes/write/{idcourse}', 'idcourse' => $course->id),'method' => 'get')); }}
                    <!--{{ Form::submit('Write Note', array('class' => 'button')); }}-->
                                        Written notes<button type="submit" class="button-image">{{ HTML::image('img/icons/plus.png', 'Write note', array('class' => 'test-image')); }}</button>

                {{Form::close();}}</h2>
    <table>
        @foreach($manuscrits as $file)
            <tr>
                <td>{{ $file->title }}</td>
                <td>
                    {{ Form::open(array('route' => array('/notes/edit/{idnote}', 'idnote' => $file->id),'method' => 'get')); }}
                        <!--{{ Form::submit('Edit', array('class' => 'button')); }}-->
                        <button type="submit" class="button-image">{{ HTML::image('img/icons/edit.png', 'Edit', array('class' => 'test-image')); }}</button>
                    {{Form::close();}}
                </td>
                <td>
                    {{ Form::open(array('route' => array('/notes/delete/{idnote}', 'idnote' => $file->id))); }}
                        <!--{{ Form::submit('Delete', array('class' => 'button')); }}-->
                        <button type="submit" class="button-image">{{ HTML::image('img/icons/delete.png', 'Delete', array('class' => 'test-image')); }}</button>
                    {{Form::close();}}
                </td>
            </tr>
        @endforeach
    </table>
    <h2>
                {{ Form::open(array('route' => array('/notes/add/{idcourse}', 'idcourse' => $course->id),'method' => 'get')); }}
                    <!--{{ Form::submit('Add File', array('class' => 'button')); }}-->
                    Files<button type="submit" class="button-image">{{ HTML::image('img/icons/plus.png', 'Add a new file', array('class' => 'test-image')); }}</button>

                {{Form::close();}}
     </h2>
     <table>
            @foreach($files as $file)
                <tr>
                    <td>{{ $file->original_filename }}</td>
                    <td>{{ Files::find($file->id)->getSize(); }}</td>
                    <td>
                        {{Form::open(array('route' => array('/notes/download/{idfile}', 'idfile' => $file->id), 'method' => 'get')); }}
                        {{ Form::submit('Download',  array('class' => 'button')); }}
                        {{Form::close();}}
                    </td>
                    <td>
                        {{ Form::open(array('route' => array('/notes/deletefile/{idfile}', 'idfile' => $file->id))); }}
                            {{ Form::submit('Delete', array('class' => 'button')); }}
                        {{Form::close();}}
                    </td>
                </tr>
            @endforeach
     </table>

@stop