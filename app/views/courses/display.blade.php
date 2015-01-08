@extends('layouts.selectclass')
@section('display')
    <div class="list-classes">
    @if(count($courses) > 0)
        @foreach($courses as $course)
        <div class="class-tile color-a">
            @if($course->getParentClass()->canRead())
                <a href="/courses/open/{{$course->id}}" class="class-title-tile color-b hover-color-a">{{$course->name}}</a>
            @else
                <div class="class-title-tile color-b">{{$course->name}}</div>
            @endif
            <table class="color-a">
                <tr>
                    <td>Created at </td>
                    <td>{{$course->created_at}}</td>
                </tr>
                <tr>
                    <td>Last update </td>
                    <td>{{$course->updated_at}}</td>
                </tr>
                <tr>
                    <td>Matter</td>
                    <td>{{$course->matter}}</td>
                </tr>
            </table>
        </div>
        @endforeach
        </div>
    @else
        <div class="class-creation-form">No course found yet.</div>
    @endif
@endsection