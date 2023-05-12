<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Document</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Varela Round', sans-serif;
        }
    </style>
    
</head>
<body>
    @if(Auth::user())
        @include('layouts.navigation')
    @endif
    @yield('content')
</body>
</html>