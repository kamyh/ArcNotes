<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
	{{HTML::style('css/mainlayout.css');}}
	{{HTML::style('css/header.css');}}
	{{HTML::style('css/leftdock.css');}}

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
				         @if(Session::get('isLogged') == 1)
				            Welcome user: //missing
                            {{ Form::open(array('url' => 'logout', 'method' => 'get')) }}
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
				<div class="context-menus-dock scroll-y">
					<?php generateLorem(10, "<div class=\"context-menu-tile hover-color-b\">context menu stuff</div>"); ?>
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