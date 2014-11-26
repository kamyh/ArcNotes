@extends('layouts.default')
@section('body')

<script type="text/javascript">
    isObject = function(a) {
        return (!!a) && (a.constructor === Object);
    };

    $(document).ready(function() {
            $.getJSON("/lists_classes_courses" ,
             { id: 0 },
             function(data) {
                var $display = $("#list-class-course");
                $display.empty();

                $.each(data, function(index, value)
                {
                    if(!isObject(value))
                    {
                        $display.append("</h1><h1>" + value);
                    }
                    else
                    {
                        $.each(value,function(index,value)
                        {
                            $display.append("</h3><h3>" + value);
                        });
                    }
                });
            });
    });
</script>

<div id="list-class-course">

</div>

@stop