<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')
        <title>Print Certificate</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.css" /> --}}
        {{-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"> --}}

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        {{-- <script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.js"></script> --}}
        {{-- <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script> --}}
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>

    <style type="text/css">
        @font-face {
            font-family: 'Monotype-Corsiva';
            src: url('/fonts/Monotype-Corsiva-Italic.TTF') format('truetype'),
                 url('/fonts/Monotype-Corsiva-Italic.woff') format('woff'),
                 url('/fonts/Monotype-Corsiva-Italic.woff2') format('woff2'),
                 url('/fonts/Monotype-Corsiva-Italic.eot') format('eot');
            font-weight: normal;
            font-style: normal;
        } 
        @font-face {
            font-family: 'Perpetua';
            src: url('/fonts/Perpetua.TTF') format('truetype'),;
            font-weight: normal;
            font-style: normal;
        } 
        @page{
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
    </style>

    <body class="antialiased w-[1375px] h-[1063px] relative">
        @php
            // Overall Score
                $date = new DateTime($training->end_date);
                $formattedDate = $date->format('jS \o\f F Y');
                $date->modify('+1 year');
                $valid_until = $date->format('Y-m-d');

                $writtenExamScore = $attendee->written_score;
                $writtenExamTotal = $exam_total;
                $drivingExamScore = $attendee->driving_score;

                $writtenPercent = 20 * ($writtenExamScore / $writtenExamTotal);
                $drivingPercent = 80 * ($drivingExamScore / 100);
                $overallScore = round(($writtenPercent + $drivingPercent), 2);

                $class = 'B';
                if($overallScore >= 95){
                    $class = 'A';
                }
            // Overall Score

            // Signature
                $thImageSize = getimagesize(public_path('storage/'.$trainer_head->signature));
                $thImageWidth = 100 / ($thImageSize[1]/$thImageSize[0]);
                $thSizeClass = 'height: 100px;';
                $thTop = 'top: 690px;';
                if($thImageWidth > 200){
                    $thSizeClass = 'width: 200px;';
                    $thImageHeight = 200 * ($thImageSize[1]/$thImageSize[0]);
                    $thTopValue = (100 - $thImageHeight) / 2;
                    $thTop = 'top: ' . (690+$thTopValue) . 'px;';
                }

                $tImageSize = getimagesize(public_path('storage/'.$training->trainerName->signature));
                $tImageWidth = 100 / ($tImageSize[1]/$tImageSize[0]);
                $tSizeClass = 'height: 100px;';
                $tTop = 'top: 690px;';
                if($tImageWidth > 200){
                    $tSizeClass = 'width: 200px;';
                    $tImageHeight = 200 * ($tImageSize[1]/$tImageSize[0]);
                    $tTopValue = (100 - $tImageHeight) / 2;
                    $tTop = 'top: ' . (690+$tTopValue) . 'px;';
                }
            // Signature

            // Control Number
                if ($attendee->brand == 'Toyota') {
                    $cBrand = 'TYT';
                }else if($attendee->brand == 'Raymond'){
                    $cBrand = 'RYMD';
                }else{
                    $cBrand = 'BT';
                }
            // Control Number
        @endphp
        {{-- All Text --}}
            <h1 style="font-family: 'Monotype-Corsiva' !important;" class="whitespace-nowrap text-[57px] absolute top-[382px] left-1/4 -translate-x-1/2">{{ $attendee->name }}</h1>
            <h2 style="font-family: 'Perpetua'" class="text-lg absolute top-[466px] left-1/4 -translate-x-1/2 uppercase whitespace-nowrap">{{ $training->customer->name }}</h2>
            <h2 style="font-family: 'Perpetua'" class="text-xl absolute top-[568px] left-1/4 -translate-x-1/2 text-center leading-[26px] whitespace-nowrap">has attended the Comprehensive Training on <br> Basic Safety Operators Training <span class="font-bold">{{ $attendee->brand . ' ' . $attendee->type }}</span></h2>
            <h2 style="font-family: 'Perpetua'" class="text-xl absolute top-[630px] left-1/4 -translate-x-1/2 text-center">Given on this {{ $formattedDate }}</h2>
            <img style="{{ $thSizeClass.$thTop }}" src="{{ asset('storage/'.$trainer_head->signature) }}" class="absolute left-[12.5%+35px] -translate-x-1/2">
            <h2 style="font-family: 'Perpetua'" class="text-xl absolute top-[772px] left-[12.5%] -translate-x-1/2">{{ ucwords(strtolower($trainer_head->first_name . ' ' . $trainer_head->last_name)) }}</h2>
            <img style="{{ $tSizeClass.$tTop }}" src="{{ asset('storage/'.$training->trainerName->signature) }}" class="absolute left-[37.5%-35px] -translate-x-1/2">
            <h2 style="font-family: 'Perpetua'" class="text-xl absolute top-[772px] left-[37.5%] -translate-x-1/2">{{ ucwords(strtolower($training->trainerName->first_name . ' ' . $training->trainerName->last_name)) }}</h2>
            <h2 style="font-family: 'Perpetua'" class="text-sm absolute bottom-[53px] left-[84px] uppercase">{{ 'TMHP-'.$cBrand.str_pad($attendee->control_number, 7, '0', STR_PAD_LEFT) }}</h2>

            @if ($overallScore >= 85)
                <h1 style="font-family: 'Monotype-Corsiva' !important;" class="whitespace-nowrap text-[57px] absolute top-[382px] left-3/4 -translate-x-1/2">{{ $attendee->name }}</h1>
                <h2 style="font-family: 'Perpetua'" class="text-lg whitespace-nowrap absolute top-[466px] left-3/4 -translate-x-1/2 uppercase">{{ $training->customer->name }}</h2>
                <h2 style="font-family: 'Perpetua'" class="text-xl whitespace-nowrap absolute top-[568px] left-3/4 -translate-x-1/2 text-center leading-[26px]">has attended the Comprehensive Training on <br> Basic Safety Operators Training <span class="font-bold">{{ $attendee->brand . ' ' . $attendee->type }}</span></h2>
                <h2 style="font-family: 'Perpetua'" class="text-xl absolute top-[630px] left-3/4 -translate-x-1/2 text-center">Given on this {{ $formattedDate }}</h2>
                <h2 style="font-family: 'Perpetua'" class="text-2xl absolute font-bold top-[657px] left-3/4 -translate-x-1/2 uppercase">Class {{$class}} ({{ $overallScore }}%) Level {{$attendee->level}}</h2>
                <img style="{{ $thSizeClass.$thTop }}" src="{{ asset('storage/'.$trainer_head->signature) }}" class="absolute left-[62.5%+35px] -translate-x-1/2">
                <h2 style="font-family: 'Perpetua'" class="text-xl absolute top-[772px] left-[62.5%] -translate-x-1/2">{{ ucwords(strtolower($trainer_head->first_name . ' ' . $trainer_head->last_name)) }}</h2>
                <img style="{{ $tSizeClass.$tTop }}" src="{{ asset('storage/'.$training->trainerName->signature) }}" class="absolute left-[87.5%-35px] -translate-x-1/2">
                <h2 style="font-family: 'Perpetua'" class="text-xl absolute top-[772px] left-[87.5%] -translate-x-1/2">{{ ucwords(strtolower($training->trainerName->first_name . ' ' . $training->trainerName->last_name)) }}</h2>
                <h2 style="font-family: 'Perpetua'" class="text-sm absolute bottom-[53px] left-[calc(50%+85px)] uppercase">{{ 'TMHP-'.$cBrand.str_pad($attendee->control_number, 7, '0', STR_PAD_LEFT) }}</h2>
                <h2 style="font-family: 'Perpetua'" class="text-sm absolute bottom-[53px] right-[64px] uppercase">{{ $valid_until }}</h2>
            @endif
        {{-- All Text --}}
        
        @if ($overallScore >= 85)
            <img src="{{ asset("storage/images/system/cert_pass.png") }}" alt="" class="w-full h-full top-0 left-0">
        @else
        <img src="{{ asset("storage/images/system/cert_fail.png") }}" alt="" class="w-full h-full top-0 left-0">
        @endif

        <script>
            $(document).ready(function(){
                window.onafterprint = window.close;
                window.print();
            });
        </script>
    </body>
</html>
