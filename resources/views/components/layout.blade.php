<!DOCTYPE html>
<html>
    <head>
        <title>Coronatime</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/js/app.js')
        @vite('resources/css/app.css')
      </head>
    <body class="h-full">
        <section>
            {{$slot}}
    </section>
    </body>
</html>