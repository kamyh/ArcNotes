@extends('layouts.default')
@section('title')
    Edit note
@endsection

@section('page-scripts')
<script type="text/javascript">
    $( document ).ready( function( $ ) {
        $( '#btnsave' ).click(function(e) {
            e.preventDefault();
            $.ajax({type: "POST",
                    url: "/notes/ajaxsave/{{$idnote}}",
                    dataType: 'json',
                    data: { title: $("#title-input").val(), content: $("#content-input").val() },
                    success: function(resp){
                        $().toastmessage('showSuccessToast',resp.msg);
                        }
                    },'json').fail(function(resp)
                    {
                        var errors = '';
                        for(i = 0; i < resp.responseJSON.errors.length; i++)
                        {
                            errors += resp.responseJSON.errors[i] + "<br />";
                        }
                        $().toastmessage('showErrorToast', errors);
                    });
            return false;
        });
    });
</script>
@endsection
@section('body')

    <div class="class-creation-form color-a">
    {{ Form::open(array('route' => array('/notes/update/{idnote}', 'idnote' => $idnote))); }}
    <table class="form">
     @if($errors->has())
        <tr>
            <td colspan="2">
        @foreach ($errors->all() as $error)
           <div class="error">{{ $error }}</div>
       @endforeach
        </td>
       </tr>
     @endif
        <tr>
            <td>{{ Form::label('title', 'Title', array('class' => 'form-label')) }}</td>
            <td>{{ Form::text('title', $title, array('size' => 100, 'maxlength' => 100, 'class' => 'text-input', 'id' => 'title-input')); }}</td>
        </tr>
        <tr>
            <td>{{ Form::label('content','Content', array('class' => 'form-label')); }}</td>
            <td>{{ Form::textarea('content', $content, array('cols' => 100, 'class' => 'textarea-input', 'id' => 'content-input')); }}</td>
        </tr>
        <tr>
           <td>&nbsp;</td><td>{{ Form::submit('Save', array('class' => 'button', 'id' => 'btnsave')); }} {{ Form::submit('Save and quit', array('class' => 'button')); }}</td>
        </tr>
    </table>
    </div>
    {{Form::close();}}
@stop


