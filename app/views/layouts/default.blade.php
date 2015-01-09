<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title>@yield('title')</title>
	{{HTML::style('css/mainlayout.css');}}
	{{HTML::style('css/header.css');}}
	{{HTML::style('css/leftdock.css');}}
	{{HTML::style('css/contentlayout.css');}}
	{{HTML::style('css/jquery.toastmessage.css');}}

    {{ HTML::script("/js/jquery-2.1.3.min.js"); }}
	{{ HTML::script("/js/jquery.toastmessage.js"); }}
    <script type="text/javascript">
    {{Tools::createToastMessages()}}</script>
    @yield('page-scripts', '')

</head>
<body>
<div class="header row color-a">
			<div id="header-title">
				<a href="/">{{ HTML::image('img/logo.png', 'logo', array('class' => 'logo')) }}</a>
			</div>
			<div id="header-menus" class="scroll-x">
			@if(Auth::check())
			     <a href="/classes/owned" title="My classes" class="header-menu-tile color-b hover-color-a">My Classes</a>
			     <a href="/classes/participant/1" title="Joined Classes" class="header-menu-tile color-b hover-color-a">Joined Classes</a>
			     <a href="/classes/create/" title="Create a new class" class="header-menu-tile color-b hover-color-a">New Class</a>
            @endif
                 <a href="/classes/public/1" title="View public classes" class="header-menu-tile color-b hover-color-a">Public Classes</a>
                 <a href="/about/" class="header-menu-tile color-b hover-color-a">About</a>
            @if(!Auth::check())
                 <a href="/signup" title="Sign up" class="header-menu-tile color-b hover-color-a">Register</a>
            @endif
			</div>
			<div id="header-search">
				<div class="header-search-tile" >
                    {{ Form::open(array('url' => '/search', 'method' => 'get')) }}
                    <table>
                        <tr><td>{{ Form::text('keyword', null, array('placeholder' => 'Search')) }}</td>
                            <td>{{ Form::select('type', array('courses' => 'Course', 'classes' => 'Class')) }}</td>
                            <td><button type="submit" class="button-image" title="Search">{{ HTML::image('img/icons/search.png', 'Search', array('class' => 'test-image')); }}</button>
                            </td>
                        </tr> </table>
                    {{ Form::close() }}</div>
			</div>
		</div>
		<div class="body row">
			<div class="left-dock col scroll-y color-a">
				<div class="profile">
				         @if(Auth::check())
				            <?php
				                $user = User::find(Auth::id());
				            ?>
				            <table>
                                <tr>
                                    <td class="color-a">
                                        Welcome {{$user->firstname}} {{$user->lastname}}!
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="/changepassword" title="Change your password" class="link hover-color-b color-a">Change password.</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    {{ Form::open(array('route' => 'logout', 'method' => 'post')) }}
                                        {{Form::submit('Logout', array('class' => 'button','title' => 'Logout'))}}
                                    {{ Form::close() }}
                                    </td>
                                </tr>
				            </table>
                        @else

                            {{ Form::open(array('url' => 'login', 'method' => 'post')) }}
                            <table>
                                 @if($errors->has())
                                <tr>
                                    <td colspan="2">
                                @foreach ($errors->all() as $error)
                                    <div class="error">{{{ $error }}}</div>
                                @endforeach
                                    </td>
                                </tr>
                                @endif
                                    <td>{{Form::text('email', null,array('class' => '', 'placeholder' => 'Email'))}}</td>
                                </tr>
                                <tr>
                                    <td>{{Form::password('password',array('class' => '', 'placeholder' => 'Password'))}}</td>
                                </tr>
                                <tr>
                                    <td>{{Form::submit('Login', array('class' => 'button','title' => 'Login'))}}</td>
                                </tr>
                            <tr>
                                 <td><a href="/signup" class="color-a link">Sign up.</a></td>
                            </tr>
                            </table>
                        {{ Form::close() }}
                        @endif
				</div>
				<div class="context-menus-dock scroll-y">
				 @if(Auth::check())
                    @foreach(Auth::user()->getClasses() as $class)

                            <a href="/classes/display/{{{$class->id}}}" class="context-menu-tile-class color-b hover-color-a">{{{$class->name}}}</a>
                            @foreach($class->getCourses() as $course)
                                <a href="/courses/open/{{{$course->id}}}" class="context-menu-tile-course hover-color-b color-a ">{{{$course->name}}}</a></br>
                            @endforeach
                    @endforeach
                 @endif
				</div>
			</div>
			<div class="content col color-b">
			    <div class="content-title row">
                <h1>@yield('title')</h1>
			    </div>
			    <div class="content-body row scroll-y">
			    @yield('body')
			    </div>
                <div class="content-footer row">
                    @yield('footer', '')
                </div>
			</div>
		</div>
		@show
</body>
</html>
