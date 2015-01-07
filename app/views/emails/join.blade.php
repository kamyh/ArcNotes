<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>New member</h2>

        <div>
            <p>{{$user->firstname}} {{$user->lastname}}</p>
            <p>joined the class {{$class->name}}</p>
            <p>Logged in your ArcNotes account to accept or refuse this person</p>
        </div>
    </body>
</html>