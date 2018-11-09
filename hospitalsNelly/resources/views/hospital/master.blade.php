<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Page Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/css/dropdown.css" />
        
    </head>
    <body onload = "getPatients()">
        @include('hospital.nav')
        <div class = "container">
            @yield('content')
        </div>

    </body>
</html>


