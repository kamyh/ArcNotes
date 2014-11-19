@extends('layouts.default')
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
        //TODO TEST
        echo Session::get('isLogged');

        $cantonList = DB::table('cantons')->lists('name','id');


        $cityList = DB::table('cities')->distinct()->lists('name','id');

        //TODO set dropdown cities to canton's cities
        ?>

        {{ Form::open(array('route' => array('school.store'), 'method' => 'post')) }}
        @if($errors->any())
            <div class="">
                <a class="" data-dismiss="alert">&times;</a>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </div>
        @endif
            {{Form::label('name','Name')}}
            {{Form::text('name', null,array('class' => ''))}}
        <br/>
            {{Form::label('canton','Canton')}}
            {{ Form::select('canton', $cantonList, null, array('class' => '' , 'id' => 'selectCanton')) }}
        <br/>

            {{Form::label('city','City')}}
            {{ Form::select('city', $cityList, null, array('class' => '', 'id' => 'selectCities')) }}
        <br/>
        {{Form::submit('Create', array('class' => ''))}}
        {{ Form::close() }}
</div>
@stop


