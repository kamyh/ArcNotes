@extends('layouts.default')
@section('title')
Index of ArcNotes
@endsection
@section('body')
	<div class="class-creation-form color-a">
    	    <div class="descr_title"><h3>Arc Notes</h3></div>
    	    <div class="descr_content">ArcNotes is a website designed around sharing notes and documents with your classmates.</div>
    	    @if(!Auth::check())
                <div class="descr_content">Create an account, create a new class, and start sharing and improving!</div>
            @else
                <div class="descr_content">Create a new class, and start sharing and improving!</div>
            @endif
    	    <br/>
            <div class="copyrights_title"><h5>Copyrights 2014-2015</h5></div>
            <div class="copyrights_content">
                Kilian Bandit-Gredin
                Nicolas-Hugues Nains
                Vincent Des-Rouages
            </div>
    	</div>
</body>
</html>
@stop