<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
	{{HTML::style('css/mainlayout.css');}}
	{{HTML::style('css/header.css');}}
	{{HTML::style('css/leftdock.css');}}
	{{HTML::style('css/contentlayout.css');}}

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


</head>
<body>
<div class="header row color-a">
			<div id="header-title">
				{{ HTML::image('img/logo.png', 'logo', array('class' => 'logo')) }}
			</div>
			<div id="header-menus" class="scroll-x">
			@if(Auth::check())
			     <a href="/manager/classowned/" class="header-menu-tile color-b hover-color-a">My Class Manager</a>
			     <a href="/class/create/" class="header-menu-tile color-b hover-color-a">New Class</a>
            @endif
                 <a href="/class/join/" class="header-menu-tile color-b hover-color-a">Public Classes</a>
                 <a href="/about/" class="header-menu-tile color-b hover-color-a">About</a>
            @if(!Auth::check())
                 <a href="/user/create" class="header-menu-tile color-b hover-color-a">Register</a>
            @endif
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
                                {{Form::submit('Logout', array('class' => 'button'))}}
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

                                {{Form::submit('Login', array('class' => 'button'))}}
                            {{ Form::close() }}
                            <a href="/user/create" class="color-a">Sign up.</a>
                        @endif
				</div>
				<div class="context-menus-dock scroll-y">
				 @if(Auth::check())
                    @foreach(Auth::user()->getClasses() as $class)

                            <a href="/class/open/{{$class->id}}" class="context-menu-tile-class color-b">{{$class->name}}</a>
                            @foreach($class->getCourses() as $course)
                                <a href="/course/open/{{$course->id}}" class="context-menu-tile-course hover-color-b color-a ">{{$course->name}}</a></br>
                            @endforeach
                    @endforeach
                 @endif
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