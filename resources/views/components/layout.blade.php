<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <title></title>
    </head>
    <body>
        <div class="content">
            {{$slot}}
        </div>
    </body>
</html>
