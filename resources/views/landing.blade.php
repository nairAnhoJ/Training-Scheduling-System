<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/flowbite.css')}}">

        <!-- Script -->
        <script src="{{asset('assets/js/jquery.js')}}"></script>
        <script src="{{asset('assets/js/flowbite.js')}}"></script>
        <script src="{{asset('assets/js/fullcalendar.js')}}"></script>

        <!-- Styles -->
        <style>
            *{
                /* font-family: 'Varela Round', sans-serif; */
                font-family: 'Comic Neue', cursive;
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
            <nav class="w-screen bg-blue-500 h-14">
                <div class="flex flex-row-reverse h-full">
                    <div class="w-36 h-full p-2.5">
                        <a href="{{ route('login') }}" class="bg-white text-blue-600 w-full h-full rounded-xl hover:scale-105 shadow-lg font-black tracking-wider flex justify-center items-center">
                            <span>LOGIN</span>
                        </a>
                    </div>
                </div>
            </nav>
            <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
                <div class="bg-white shadow-xl rounded-lg py-5 pl-5 pr-8 h-full overflow-y-scroll">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'title',
                        center: '',
                        right: 'prev,next today'
                    },
                    initialView: 'dayGridMonth',
                    contentHeight: 'auto',
                    
                    events: [
                        {
                            title: 'BCH237',
                            start: '2023-05-12 15:30:00',
                            extendedProps: {
                                department: 'BioChemistry'
                            },
                            description: 'Lecture'
                        },
                        {
                            title: 'Event 2',
                            start: '2023-05-23 05:30:00',
                        },
                        {
                            title: 'Event 3',
                            start: '2023-05-04'
                        },
                    ]
                });
                calendar.render();
            });
        </script>
    </body>
</html>
