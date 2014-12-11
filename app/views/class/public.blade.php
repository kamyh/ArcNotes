@extends('layouts.default')
@section('title')
    Public classes
@endsection
@section('body')

       <h2>Public Classes</h2>
        <div class="list-classes">
        @foreach($classes_public as $class)
        <div class="class-tile color-a">
            <a href="/class/open/{{$class->id}}" class="class-title-tile color-b hover-color-a">{{$class->name}}</a>
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
                    {{ Form::open(array('route' => array('/class/sign/{idclass}','idclass'=>$class->id), 'method' => 'get')) }}
                        {{Form::submit('Join', array('class' => ''))}}
                    {{ Form::close() }}
                </td>
            </tr>
            </table>
            </div>
        @endforeach
        </div>
@stop