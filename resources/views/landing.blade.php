<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Schedule Board</title>

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
        @csrf
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
                            <h3 id="name" class="text-xl tracking-wide font-semibold text-gray-900 flex items-center"></h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="viewEventModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                    <div class="p-6 overflow-y-auto overflow-x-hidden h-[calc(100vh-220px)]">
                        <div class="">
                            <div class="grid grid-cols-6">
                                <div class="col-span-2">Date: </div>
                                <div id="event_date" class="col-span-4 font-semibold text-lg"></div>

                                <div class="col-span-2">Venue: </div>
                                <div id="venue" class="col-span-4 font-semibold text-lg"></div>

                                <div class="col-span-2">Trainer: </div>
                                <div id="trainer" class="col-span-4 font-semibold text-lg"></div>
                            </div>

                            <div class="mt-5">
                                <div class="flex items-center">
                                    <h1 class="text-xl mr-3 whitespace-nowrap text-gray-700 font-bold tracking-wider">CUSTOMER DETAILS</h1><hr class="w-full whitespace-nowrap border-gray-500">
                                </div>
                                <div class="grid grid-cols-6">
                                    <div class="col-span-2">Address: </div>
                                    <div id="address" class="col-span-4 font-semibold text-lg"></div>

                                    <h3 class="font-semibold col-span-6">Contact Person/s:</h3>
                                    <div id="cp1_div" class="col-span-6 grid grid-cols-6">
                                        <div class="ml-10 col-span-2">Name: </div>
                                        <div id="cp1_name" class="col-span-4 font-semibold text-lg"></div>
                                        <div class="ml-10 col-span-2">Date: </div>
                                        <div id="cp1_number" class="col-span-4 font-semibold text-lg"></div>
                                        <div class="ml-10 col-span-2">E-mail: </div>
                                        <div id="cp1_email" class="col-span-4 font-semibold text-lg"></div>
                                    </div>

                                    <div id="cp2_div" class="col-span-5 grid grid-cols-5">
                                        <div class="ml-10 mt-5">Name: </div>
                                        <div id="cp2_name" class="col-span-4 font-semibold text-lg mt-5"></div>
                                        <div class="ml-10">Date: </div>
                                        <div id="cp2_number" class="col-span-4 font-semibold text-lg"></div>
                                        <div class="ml-10">E-mail: </div>
                                        <div id="cp2_email" class="col-span-4 font-semibold text-lg"></div>
                                    </div>

                                    <div id="cp3_div" class="col-span-5 grid grid-cols-5">
                                        <div class="ml-10 mt-5">Name: </div>
                                        <div id="cp3_name" class="col-span-4 font-semibold text-lg mt-5"></div>
                                        <div class="ml-10">Date: </div>
                                        <div id="cp3_number" class="col-span-4 font-semibold text-lg"></div>
                                        <div class="ml-10">E-mail: </div>
                                        <div id="cp3_email" class="col-span-4 font-semibold text-lg"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <div class="flex items-center">
                                    <h1 class="text-xl mr-3 whitespace-nowrap text-gray-700 font-bold tracking-wider">OTHER DETAILS</h1><hr class="w-full whitespace-nowrap border-gray-500">
                                </div>
                                <div class="grid grid-cols-6">
                                    <div class="col-span-2">Area: </div>
                                    <div id="area" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Category: </div>
                                    <div id="category" class="col-span-4 font-semibold text-lg"></div>
                                    <div id="con_details_div" class="col-span-6 grid grid-cols-6">
                                        <div class="col-span-2">Contract Details: </div>
                                        <a href="#" id="contract_details" target="_blank" class="col-span-4 font-semibold text-lg text-white bg-blue-500 rounded-lg w-40 tracking-wide text-center hover:scale-105">VIEW</a>
                                    </div>
                                    <div class="col-span-2">Brand: </div>
                                    <div id="brand" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Model: </div>
                                    <div id="model" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Type of Unit: </div>
                                    <div id="unit_type" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Billing Type: </div>
                                    <div id="billing_type" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Number of Attendees: </div>
                                    <div id="no_of_attendees" class="col-span-4 font-semibold text-lg">13</div>
                                    <div class="col-span-2">Knowledge of Participants: </div>
                                    <div id="knowledge_of_participants" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Notes: </div>
                                    <div class="col-span-4 font-semibold">
                                        <textarea id="remarks" class="w-full border-0 ring-0 focus:ring-0 p-0 text-lg resize-none cursor-default" readonly></textarea>
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
                var eventArray = @json($eventArray);
  
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: '', // addButton
                        center: 'title',
                        right: 'prev,next today'
                    },
                    customButtons: {
                        addButton: {
                            text: 'ADD',
                            classNames: 'myButtonClass',
                            click: function() {
                                // Perform your custom action here
                                alert('Custom button clicked!'); 
                            }
                        }
                    },
                    initialView: 'dayGridMonth',
                    contentHeight: 'auto',

                    eventMouseEnter: function (info) {
                        info.el.classList.add('cursor-pointer');
                        info.el.classList.add('hover:scale-105'); 
                    },
                    eventClick: function(calEvent, jsEvent, view) {
                        var id = calEvent.event.id;
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url:"{{ route('guest.view') }}",
                            method:"POST",
                            dataType: 'json',
                            data:{
                                id: id,
                                _token: _token
                            },
                            success:function(result){
                                $('#event_date').html(result.event_date);
                                $('#venue').html(result.venue);
                                $('#trainer').html(result.trainer);
                                if(result.event_date != '' && result.venue != '' && result.trainer != '' && result.event_date != null && result.venue != null && result.trainer != null){
                                    $('#approveButton').prop('disabled', false);
                                    // $('#approveButton').attr('href', `/request/approve/${result.key}`);
                                }else{
                                    $('#approveButton').prop('disabled', 'true');
                                }

                                $('#name').html(result.name);
                                $('#address').html(result.address);

                                if(result.cp1_name != ''){
                                    $('#cp1_name').html(result.cp1_name);
                                    $('#cp1_number').html(result.cp1_number);
                                    $('#cp1_email').html(result.cp1_email);
                                }else{
                                    $('#cp1_div').addClass('hidden');
                                }

                                if(result.cp2_name != ''){
                                    $('#cp2_name').html(result.cp2_name);
                                    $('#cp2_number').html(result.cp2_number);
                                    $('#cp2_email').html(result.cp2_email);
                                }else{
                                    $('#cp2_div').addClass('hidden');
                                }

                                if(result.cp3_name != ''){
                                    $('#cp3_name').html(result.cp3_name);
                                    $('#cp3_number').html(result.cp3_number);
                                    $('#cp3_email').html(result.cp3_email);
                                }else{
                                    $('#cp3_div').addClass('hidden');
                                }

                                $('#area').html(result.area);
                                $('#category').html(result.category);

                                if(result.is_PM == 1){
                                    $('#con_details_div').removeClass('hidden');
                                    if(result.contract_details == null){
                                        $('#contract_details').addClass('pointer-events-none opacity-50');
                                    }else{
                                        $('#contract_details').removeClass('pointer-events-none opacity-50');
                                        $('#contract_details').attr('href', `/request/view/contract-details/${result.key}`);
                                    }
                                }else{
                                    $('#con_details_div').addClass('hidden');
                                }

                                $('#brand').html(result.brand);
                                $('#model').html(result.model);
                                $('#unit_type').html(result.unit_type);
                                $('#billing_type').html(result.billing_type);
                                $('#no_of_attendees').html(result.no_of_attendees);
                                $('#knowledge_of_participants').html(result.knowledge_of_participants);
                                $('#remarks').html(result.remarks);

                                $('#confirmApproveButtona').attr('href', `/request/approve/${result.key}`);
                                
                                $('#viewEventButton').click();
                                autoResize();
                            }
                        })
                    },
                    events: eventArray
                });
                calendar.render();

                $('.fc-addButton-button').removeClass('fc-button-primary fc fc-button');
                $('.fc-addButton-button').addClass('bg-blue-500 font-bold h-10 px-10 rounded-lg text-white tracking-wider hover:scale-105');

                function autoResize() {
                    var textarea = $('#remarks');
                    textarea.css('height', 'auto');
                    textarea.css('height', textarea[0].scrollHeight + 'px');
                }
            });
        </script>
    </body>
</html>
