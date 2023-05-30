<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet"> --}}
        {{-- <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Flow+Rounded&family=Varela+Round&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/flowbite.css')}}">

        <!-- Script -->
        <script src="{{asset('assets/js/jquery.js')}}"></script>
        <script src="{{asset('assets/js/tailwindcss.js')}}"></script>
        <script src="{{asset('assets/js/flowbite.js')}}"></script>
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

        {{-- VIEW EVENT MODAL --}}
            <!-- Modal toggle -->
            <button data-modal-target="viewEventModal" data-modal-toggle="viewEventModal" id="viewEventButton" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                Toggle modal
            </button>
            
            <!-- Main modal -->
            <div id="viewEventModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-3xl h-full bg-white rounded-lg overflow-x-hidden overflow-y-auto">
                    <!-- Modal content -->
                    <div class="relative shadow text-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 border-b rounded-t bg-blue-500">
                            <h3 id="viewCompanyName" class="text-xl tracking-wide font-semibold text-gray-900 flex items-center"></h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="viewEventModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                    <div class="p-6 overflow-y-auto overflow-x-hidden h-[calc(100vh-220px)]">
                        <div class="">
                            <div class="grid grid-cols-5">
                                <div>Date: </div>
                                <div id="viewDate" class="col-span-4 font-semibold text-lg">DATE NGAYON (M d, YYYY)</div>

                                <div>Venue: </div>
                                <div id="viewDate" class="col-span-4 font-semibold text-lg">VENUE NG TRAINING</div>
                            </div>

                            <div class="mt-5">
                                <div class="flex items-center">
                                    <h1 class="text-xl mr-3 whitespace-nowrap text-gray-700 font-bold tracking-wider">CUSTOMER DETAILS</h1><hr class="w-full whitespace-nowrap border-gray-500">
                                </div>
                                <div class="grid grid-cols-5">
                                    <div>Address: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">ADDRESS NG CUSTOMER</div>

                                    <h3 class="font-semibold col-span-5">Contact Person/s:</h3>
                                    <div class="ml-10">Name: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">JUAN DELA CRUZ</div>
                                    <div class="ml-10">Date: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">09123456789</div>
                                    <div class="ml-10 mb-5">E-mail: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">juan.delacruz@email.com</div>

                                    <div class="ml-10">Name: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">JUAN DELA CRUZ</div>
                                    <div class="ml-10">Date: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">09123456789</div>
                                    <div class="ml-10 mb-5">E-mail: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">juan.delacruz@email.com</div>
                                </div>
                            </div>

                            <div class="">
                                <div class="flex items-center">
                                    <h1 class="text-xl mr-3 whitespace-nowrap text-gray-700 font-bold tracking-wider">OTHER DETAILS</h1><hr class="w-full whitespace-nowrap border-gray-500">
                                </div>
                                <div class="grid grid-cols-5">
                                    <div>Category: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">RENTAL UNIT</div>
                                    <div>Billing Type: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">CHARGEABLE</div>
                                    <div>Area: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">NORTH</div>
                                    <div>Type of Unit: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">REACH TRUCK</div>
                                    <div>Pax: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">13</div>
                                    <div>Trainer: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">CARDO DALISAY</div>
                                    <div>Status: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">Scheduled</div>
                                    <div>Notes: </div>
                                    <div class="col-span-4 font-semibold">
                                        <textarea id="viewNotes" class="w-full border-0 ring-0 focus:ring-0 p-0 text-lg resize-none cursor-default" readonly>DITO YUNG MGA REMARKS  NG EVENT OR KAHIT ANO NA GUSTONG ILAGAY NI COORDINATOR, PWEDE RIN ITONG BLANGKO</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                            {{-- <button data-modal-hide="viewEventModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">I accept</button> --}}
                            <button data-modal-hide="viewEventModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
        {{-- VIEW EVENT MODAL END --}}
  

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
                <div class="bg-white shadow-xl rounded-lg py-5 pl-5 pr-8 h-full overflow-y-scroll sca">
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

                    eventMouseEnter: function (info) {
                        info.el.classList.add('cursor-pointer');
                        info.el.classList.add('hover:scale-105');
                    },
                    eventClick: function(calEvent, jsEvent, view) {
                        var name = calEvent.event.title;
                        $('#viewCompanyName').html(name);
                        $('#viewEventButton').click();
                        autoResize();
                    },
                    events: [
                        {
                            id: '1',
                            title: 'ABENSON CORP. QUANTA PAPER MEXICO',
                            start: '2023-05-12',
                            extendedProps: {
                                department: 'BioChemistry'
                            },
                        },
                        {
                            id: '2',
                            title: 'LAZADA E-SERVICES PHILS INC. ',
                            start: '2023-05-27',
                            extendedProps: {
                                department: 'BioChemistry'
                            },
                        },
                    {
                        id: '3',
                        title: 'A&B SUMMIT DISTRIBUTION INC.',
                        start: '2023-05-30',
                        extendedProps: {
                            department: 'BioChemistry'
                        },
                    },
                    ]
                });
                calendar.render();

                function autoResize() {
                    var textarea = $('#viewNotes');
                    textarea.css('height', 'auto');
                    textarea.css('height', textarea[0].scrollHeight + 'px');
                }
            });
        </script>
    </body>
</html>
