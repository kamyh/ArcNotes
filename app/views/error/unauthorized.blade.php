@extends("layouts.default")
@section('title')
    Unauthorized
@endsection

@section("body")

    <div class="class-creation-form color-a">
        <p>401, motorless tractor</p>
        <p>Maybe you're not connected, maybe you don't have enough rights, maybe E.T. telephones home. <br />Try to connect and/or join the class to access what you're looking for. Kiss and love !</p>
        {{HTML::image('img/unauthorized.png')}}
    </div>
@endsection