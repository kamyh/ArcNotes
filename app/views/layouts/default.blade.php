<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
	{{HTML::style('css/mainlayout.css');}}
	{{HTML::style('css/header.css');}}
	{{HTML::style('css/leftdock.css');}}

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

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
                            $.each(value,function(entry)
                            {
                                $display.append('<div onClick="location.href=\'/cours/open/'+ entry +'\'" class="context-menu-tile hover-color-b">' + value[entry] + "</a></div>");
                            });
                        }
                    });
                });
        });
    </script>
</head>
<body>
<div class="header row color-a">
			<div id="header-title">
				{{ HTML::image('img/logo.png') }}
			</div>
			<div id="header-menus" class="scroll-x">
				<?php generateLorem(5, "<div class=\"header-menu-tile color-b hover-color-a\">menu</div>"); ?>
			</div>
			<div id="header-search">
				<div class="header-search-tile" > search bar </div>
			</div>
		</div>
		<div class="body row">
			<div class="left-dock col scroll-y color-a">
				<div class="profile">
				         @if(Auth::check())
				            <?php
				                $user = DB::table('users')->where('id','=',Auth::id())->first();
				            ?>
				            Welcome: {{$user->firstname}} {{$user->lastname}}
                            {{ Form::open(array('route' => 'logout', 'method' => 'post')) }}
                                {{Form::submit('Logout', array('class' => ''))}}
                            {{ Form::close() }}

                        @else

                            {{ Form::open(array('url' => 'login', 'method' => 'post')) }}
                                @if($errors->any())
                                    <div class="">
                                        <a class="" data-dismiss="alert">&times;</a>
                                        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                                    </div>
                                @endif
                                {{Form::label('email','Email')}}
                                {{Form::text('email', null,array('class' => ''))}}        <br/>

                                {{Form::label('password','Password')}}
                                {{Form::password('password',array('class' => ''))}}        <br/>

                                {{Form::submit('Login', array('class' => ''))}}
                            {{ Form::close() }}
                            <a href="/user/create">Sign up.</a>
                        @endif
				</div>
				<div class="context-menus-dock scroll-y" id="list-class-course">

				</div>
			</div>
			<div class="content col scroll-y color-b">
				@yield('body')
			</div>
		</div>
		@show
</body>
</html>

<?php
	function generateLorem($n, $text, $newline = false)
	{
		for( $i = 0; $i < $n; $i++)
		{
			echo $text;
			if( $i %20 == 0 && $newline)
			{
				echo "<br/>";
			}
		}
	}
?>