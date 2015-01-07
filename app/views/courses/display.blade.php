@extends('layouts.selectclass')
@section('display')
    <div class="list-classes">
        @foreach($courses as $course)
        <div class="class-tile color-a">
            <a href="/courses/open/{{$course->id}}" class="class-title-tile color-b hover-color-a">{{$course->name}}</a>
            <table>
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
@endsection