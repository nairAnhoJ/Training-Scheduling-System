<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Flow+Rounded&family=Varela+Round&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/flowbite.css')}}">

    <!-- Script -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/moment.js')}}"></script>
    {{-- <script src="{{asset('assets/js/tailwindcss.js')}}"></script> --}}
    <script src="{{asset('assets/js/flowbite.js')}}"></script>
    <script src="{{asset('assets/js/datepicker.js')}}"></script>
    <script src="{{asset('assets/js/fullcalendar.js')}}"></script>

    <!-- Styles -->
    <style>
        *{
            /* font-family: 'Varela Round', sans-serif; */
            /* font-family: 'Comic Neue', cursive; */
            font-family: 'Varela Round', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
      
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 2px grey; 
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #4B5563; 
            border-radius: 10px;
        }
      
        ::-webkit-scrollbar-thumb:hover {
            background: rgb(95, 95, 110);
        }

    </style>
</head>
<body>
    <div class="w-screen h-screen overflow-hidden">
        @if(Auth::user())
            @if(Auth()->user()->first_time_login != '1')
                @include('layouts.navigation')
            @endif
        @endif
        
        @yield('content')
    </div>
</body>
</html>