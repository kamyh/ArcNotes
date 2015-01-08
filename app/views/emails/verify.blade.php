<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            Thanks for creating an account on ArcNotes.
            Please follow the link below to verify your email address:<br/>
            <a href="{{ URL::to('/verify/' . $confirmation_code) }}">Verify</a>
        </div>
    </body>
</html>