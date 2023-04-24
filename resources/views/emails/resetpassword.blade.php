<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('titles.recoverpassword') }}</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; text-align: center;">
        <img src="https://i.ibb.co/K2xVn3t/Landing-Worldwide-2.png" style="width: 100%; max-width: 600px;">
        <h1 style="font-size: 2em; font-weight: 900; margin-top: 1em; font-family: Inter;">{{ trans('titles.recoverpassword') }}</h1>
        <p style="margin-top: 1em; font-family: Inter;">{{ trans('titles.clickthebuttontorecover') }}</p>
        <a href="{{ $resetUrl }}" 
        style="background-color: green; color: white; display: inline-block; padding: 1em; text-decoration: none; margin-top: 1em; width: 30%;">
        {{ trans('titles.recoverpassword') }}</a>
    </div>
</body>
</html>