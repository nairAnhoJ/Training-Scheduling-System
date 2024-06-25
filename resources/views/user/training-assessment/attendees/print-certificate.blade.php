<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')
        <title>Print Certificate</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.css" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.js"></script>
        <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <style type="text/css" media="print">
        @font-face {
            font-family: 'Monotype-Corsiva';
            src: url('{{ asset('storage/font/monotype-corsiva-italic.otf') }}') format('opentype');
        } 
        @page{
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
        h1 {
            font-family: 'Monotype-Corsiva';
        }
    </style>

    <body class="font-sans antialiased w-[1375px] h-[1063px] relative">
        {{-- All Text --}}
            <h1 class="text-[57px] absolute top-[380px] left-1/4 -translate-x-1/2">{{ $attendee->name }}</h1>
            <h2 class="text-lg absolute top-[468px] left-1/4 -translate-x-1/2 uppercase font-serif">{{ $training->customer->name }}</h2>
            <h2 class="absolute top-[668px] left-1/4 -translate-x-1/2 font-serif text-center">has attended the Comprehensive Training on <br> Basic Safety Operators Training <span class="font-bold">{{ $attendee->brand . ' ' . $attendee->type }}</span></h2>
            <h2 class="absolute top-[768px] left-1/4 -translate-x-1/2 font-serif text-center">Given on this </h2>
        {{-- All Text --}}

        <img src="{{ asset("storage/images/system/certificate.png") }}" alt="" class="w-full h-full top-0 left-0">

        <script>
            $(document).ready(function(){
                // var sh = $('#userAgreement').prop('scrollHeight');
                // $('#userAgreement').height((sh) + 'px');
                // window.onafterprint = window.close;
                window.print();
            });
        </script>
    </body>
</html>
