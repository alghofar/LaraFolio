<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Welcome</h2>

        <p><b>Account:</b> {{{ $email }}}</p>
        <p>To activate your account, <a href="{{ URL::route('auth.activate', ['id' => $user_id, 'token' => $token]) }}">click here.</a></p>
        <p>Or point your browser to this address: <br /> {{ URL::route('auth.activate', ['id' => $user_id, 'token' => $token]) }}</p>
        <p>Thank you, <br />
        ~The Dev Team</p>
    </body>
</html>
