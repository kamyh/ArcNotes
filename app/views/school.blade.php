@extends('layouts.default')
@section('title')
    School
@endsection
@section('body')

<script type="text/javascript">
    $(document).ready(function() {
        $("#selectCanton").change(function() {
            $.getJSON("/searchcities/" + $("#selectCanton").val(),
             { id_canton: $("#selectCanton").val() },
             function(data) {
                var $cities = $("#selectCities");
                $cities.empty();

                $.each(data, function(index, value)
                {
                    $cities.append('<option value="' + index +'">' + value + '</option>');
                });
            });
        });
    });
</script>


<div class="">
        <h2>new school</h2>
        <?php

        $cantonList = DB::table('cantons')->lists('name','id');

        $cityList = DB::table('cities')->distinct()->lists('name','id');

        //TODO set dropdown cities to canton's cities
        ?>
        <table>
            {{ Form::open(array('route' => array('school.store'), 'method' => 'post')) }}
            @if($errors->any())
            <tr>
                <td>
                <div class="">
                    <a class="" data-dismiss="alert">&times;</a>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </div>
                </td>
            </tr>
            @endif
            <tr>
                <td>
                {{Form::label('name','Name')}}
                </td>
                <td>
                {{Form::text('name', null,array('class' => ''))}}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('canton','Canton')}}
                </td>
                <td>
                {{ Form::select('canton', $cantonList, null, array('class' => '' , 'id' => 'selectCanton')) }}
                </td>
            </tr>
            <tr>
                <td>
                {{Form::label('city','City')}}
                </td><td>
                {{ Form::select('city', $cityList, null, array('class' => '', 'id' => 'selectCities')) }}
                </td>
            </tr>

            @if(isset($input))
                @foreach(array_keys($input) as $key)
                    @if($key != '_token')
                        {{ Form::hidden($key, $input[$key]) }}
                    @endif
                @endforeach
            @endif
            <tr>
                <td>
                {{Form::submit('Create', array('class' => ''))}}
                </td>
            </tr>
            {{ Form::close() }}
        </table>
</div>
@stop


