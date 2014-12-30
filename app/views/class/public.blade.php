<!--
Inputs:
   $title           ==> Page title
   $numberOfPage    ==> Number total of page needed to display all classes
   $pageNo          ==> N° of the current page
   $classes         ==> Array of the classes to display in the current page

   See getpublic($page) function in the bottom of ClassController to have an exemple
-->
@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('body')

       <h2>{{$title}}</h2>
        <div class="list-classes">
        @foreach($classes as $class)
        <div class="class-tile color-a">
            <a href="/class/display/{{$class->id}}" class="class-title-tile color-b hover-color-a">{{$class->name}}</a>
            <table>
                <tr>
                    <td>Created at </td>
                    <td> {{ $class->created_at }} </td>
                </tr>
                <tr>
                    <td>Last update </td>
                    <td> {{ $class->updated_at }} </td>
                </tr>
                <tr>
                    <td>{{$class->getSchoolName()}}</td>
                    <td>{{$class->getCitie()}} {{$class->getCanton()}}</td>
                </tr>
                <tr>
                    <td>Schollar year</td>
                    <td>{{$class->scollaryear}}</td>
                </tr>
                <tr>
                    <td>Degree</td>
                    <td>{{$class->degree}}</td>
                </tr>
                <tr>
                    <td>Domain</td>
                    <td>{{$class->domain}}</td>
                </tr>
                <tr>
                    <td>Visibility</td>
                    <td>{{$class->visibility}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    @if(Auth::check())
                        {{ Form::open(array('route' => array('/class/sign/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                            {{Form::submit('Join', array('class' => 'button'))}}
                        {{ Form::close() }}
                    @endif
                    </td>
                </tr>
            </table>
        </div>
        @endforeach
        </div>
        <div class="page-navigation">
            @for($i = 1;$i < $numberOfPages+1;$i++)
                @if($i == $pageNo)
                    <a href="/class/public/{{$i}}" class="page-navigation-current">{{$i}}</a>
                @else
                    <a href="/class/public/{{$i}}" class="page-navigation-not-current">{{$i}}</a>
                @endif
            @endfor
        </div>
@stop









