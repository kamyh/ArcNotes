@extends('layouts.default')
@section('title')
    {{ $course->name }}
@endsection
@section('page-scripts')
<script type="text/javascript">
    function copyToClipboard(text) {
      window.prompt("Copy to clipboard to share: Ctrl+C then Enter", text);
    }
</script>
@endsection
@section('body')


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
                Written notes
                      @if(Auth::check() && $course->getParentClass()->canCreate())
                          <button title="Write note" type="submit" class="button-image">{{ HTML::image('img/icons/plus.png', 'Write note', array('class' => 'test-image')); }}</button>
                      @endif
        {{Form::close();}}
    </h2>
    <table>
        @foreach($manuscrits as $manuscrit)

            <tr>
                @if(Auth::check() && $course->getParentClass()->canRead())
                    <td><a href="/notes/read/{{$manuscrit->id}}" class="context-menu-tile-class color-a">{{$manuscrit->title}}</a></td>
                @else
                    <td><span class="context-menu-tile-class color-a">{{$manuscrit->title}}</span></td>
                @endif
                 @if(Auth::check() && $course->getParentClass()->canEdit())
                <td>
                    {{ Form::open(array('route' => array('/notes/edit/{idnote}', 'idnote' => $manuscrit->id),'method' => 'get')); }}
                        <button title="Edit note" type="submit" class="button-image">{{ HTML::image('img/icons/edit.png', 'Edit', array('class' => 'test-image')); }}</button>
                    {{Form::close();}}
                </td>
                @endif
                 <td>
                     @if(Auth::check() && $course->getParentClass()->canRead())
                        <button title="Share note" type="submit" class="button-image" onclick="copyToClipboard('{{ Request::root() . '/notes/shared/' .$manuscrit->token }}')">{{ HTML::image('img/icons/share.png', 'Share', array('class' => 'test-image')); }}</button>
                     @endif
                 </td>
                 <td>
                 @if(Auth::check() && $course->getParentClass()->canCreate())
                    {{ Form::open(array('route' => array('/notes/delete/{idnote}', 'idnote' => $manuscrit->id))); }}
                        <button title="Delete note" type="submit" class="button-image">{{ HTML::image('img/icons/delete.png', 'Delete', array('class' => 'test-image')); }}</button>
                    {{Form::close();}}
                 @endif
                </td>
            </tr>
        @endforeach
    </table>
    <h2>
                {{ Form::open(array('route' => array('/notes/add/{idcourse}', 'idcourse' => $course->id),'method' => 'get')); }}
                    Files
                    @if(Auth::check() && $course->getParentClass()->canCreate())
                        <button title="Upload note" type="submit" class="button-image">{{ HTML::image('img/icons/plus.png', 'Add a new file', array('class' => 'test-image')); }}</button>
                    @endif
                {{Form::close();}}
     </h2>
     <table>
            @foreach($files as $file)
                <tr>
                    @if(Auth::check() && $course->getParentClass()->canRead())
                        <td><a href="/notes/download/{{$file->id}}" class="context-menu-tile-class color-a">{{$file->original_filename}}</a></td>
                    @else
                        <td><a href="#" class="context-menu-tile-class color-a">{{$file->original_filename}}</a></td>
                    @endif
                    <td>{{ Files::find($file->id)->getSize(); }}</td>
                    <td>
                        {{Form::open(array('route' => array('/notes/download/{idfile}', 'idfile' => $file->id), 'method' => 'get')); }}
                        <button title="Download note" type="submit" class="button-image">{{ HTML::image('img/icons/download.png', 'Share', array('class' => 'test-image')); }}</button>                        {{Form::close();}}
                    </td>
                    <td>
                        {{ Form::open(array('route' => array('/notes/deletefile/{idfile}', 'idfile' => $file->id))); }}
                            <button type="submit" class="button-image">{{ HTML::image('img/icons/delete.png', 'Share', array('class' => 'test-image')); }}</button>
                        {{Form::close();}}
                    </td>
                    <td>
                     @if(Auth::check() && $course->getParentClass()->canCreate())
                            <button title="Share note" type="submit" class="button-image" onclick="copyToClipboard('{{Request::root() . '/notes/shared/' .$file->token}}')">{{ HTML::image('img/icons/share.png', 'Share', array('class' => 'test-image')); }}</button>
                     @endif
                    </td>
                </tr>
            @endforeach
     </table>

@stop