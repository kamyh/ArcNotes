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
        @if(Auth::check() && $course->getParentClass()->canCreate())
        <tr>
            <td>
            </td>
            <td>
            </td>
        </tr>
        @endif
    </table>
    <h2>
                {{ Form::open(array('route' => array('/notes/write/{idcourse}', 'idcourse' => $course->id),'method' => 'get')); }}
                    <!--{{ Form::submit('Write Note', array('class' => 'button')); }}-->
                                        Written notes
                                        @if(Auth::check() && $course->getParentClass()->canCreate())
                                            <button type="submit" class="button-image">{{ HTML::image('img/icons/plus.png', 'Write note', array('class' => 'test-image')); }}</button>
                                        @endif
                {{Form::close();}}</h2>
    <table>
        @foreach($manuscrits as $file)
            <tr>
                @if(Auth::check() && $course->getParentClass()->canRead())
                    <td><a href="/notes/read/{{$file->id}}" class="context-menu-tile-class color-a">{{$file->title}}</a></td>
                @else
                    <td><a href="#" class="context-menu-tile-class color-a">{{$file->title}}</a></td>
                @endif
                 @if(Auth::check() && $course->getParentClass()->canEdit())
                <td>
                    {{ Form::open(array('route' => array('/notes/edit/{idnote}', 'idnote' => $file->id),'method' => 'get')); }}
                        <!--{{ Form::submit('Edit', array('class' => 'button')); }}-->
                        <button type="submit" class="button-image">{{ HTML::image('img/icons/edit.png', 'Edit', array('class' => 'test-image')); }}</button>
                    {{Form::close();}}
                </td>
                @endif
                <td>
                 @if(Auth::check() && $course->getParentClass()->canCreate())
                    {{ Form::open(array('route' => array('/notes/delete/{idnote}', 'idnote' => $file->id))); }}
                        <!--{{ Form::submit('Delete', array('class' => 'button')); }}-->
                        <button type="submit" class="button-image">{{ HTML::image('img/icons/delete.png', 'Delete', array('class' => 'test-image')); }}</button>
                    {{Form::close();}}
                 @endif
                </td>
            </tr>
        @endforeach
    </table>
    <h2>

                {{ Form::open(array('route' => array('/notes/add/{idcourse}', 'idcourse' => $course->id),'method' => 'get')); }}
                    <!--{{ Form::submit('Add File', array('class' => 'button')); }}-->
                    Files
                    @if(Auth::check() && $course->getParentClass()->canCreate())
                        <button type="submit" class="button-image">{{ HTML::image('img/icons/plus.png', 'Add a new file', array('class' => 'test-image')); }}</button>
                    @endif
                {{Form::close();}}
     </h2>
     <table>
            @foreach($files as $file)
                <tr>
                    @if(Auth::check() && $course->getParentClass()->canRead())
                        <td><a href="/notes/read/{{$file->id}}" class="context-menu-tile-class color-a">{{$file->original_filename}}</a></td>
                    @else
                        <td><a href="#" class="context-menu-tile-class color-a">{{$file->original_filename}}</a></td>
                    @endif
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