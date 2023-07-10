@extends('layouts.app')
@section('title','SCHEDULED TRAININGS')
@section('content')

    <style>
        .datepicker{
            z-index: 61;
        }
    </style>

    @if(session('success'))
        <div id="alert-3" class="absolute left-1/2 -translate-x-1/2 top-16 z-[99] shadow-lg border border-emerald-500 w-[calc(100%-10px)] sm:w-[500px] flex p-4 mb-4 text-green-50 rounded-lg bg-emerald-500 transition-all duration-500" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button" id="notifCloseButton" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 hover:scale-105 inline-flex h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif

    {{-- CANCEL MODAL --}}
        <!-- Main modal -->
        <div id="confirmCancelModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-xl bg-white border-2 border-gray-300 shadow-2xl rounded-lg overflow-x-hidden overflow-y-auto">
                <!-- Modal content -->
                <div class="relative shadow text-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl tracking-wide font-semibold text-gray-900 flex items-center">CANCEL TRAINING</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="confirmCancelModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        Are you sure you want to cancel this training?
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="confirmCancelButtona" type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">CANCEL</button>
                        <button id="closeConfirmApproveButton" data-modal-hide="confirmCancelModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- CANCEL MODAL END --}}

    {{-- RESCHEDULE MODAL --}}
        <!-- Main modal -->
        <div id="rescheduleModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-xl bg-white border-2 border-gray-300 shadow-2xl rounded-lg overflow-x-hidden overflow-y-auto">
                <!-- Modal content -->
                <form method="POST" action="{{ route('trainings.reschedule') }}" class="relative shadow text-gray-700">
                    @csrf
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl tracking-wide font-semibold text-gray-900 flex items-center">RESCHEDULE TRAINING</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="rescheduleModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        <input type="hidden" id="reschedKey" name="key">
                        <div class="mb-3 w-full">
                            <label for="rescheduleDate" class="block text-sm font-semibold text-gray-600">Date</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input datepicker type="text" id="rescheduleDate" name="rescheduleDate" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">RESCHEDULE</button>
                        <button id="closeConfirmApproveButton" data-modal-hide="rescheduleModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- RESCHEDULE MODAL END --}}

    {{-- VIEW EVENT MODAL --}}
        <!-- Modal toggle -->
        <button data-modal-target="viewRequestModal" data-modal-toggle="viewRequestModal" id="viewRequestButton" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button"></button>
        
        <!-- Main modal -->
        <div id="viewRequestModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-full h-full bg-white rounded-lg overflow-x-hidden overflow-y-auto">
                <!-- Modal content -->
                <div class="relative shadow text-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 id="name" class="text-xl tracking-wide font-semibold text-gray-900 flex items-center"></h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="viewRequestModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 overflow-y-hidden overflow-x-hidden grid grid-cols-5 h-[calc(100vh-220px)]">
                        <div class="col-span-3 border-r p-4 overflow-y-auto overflow-x-hidden h-[calc(100vh-268px)]">
                            <div class="grid grid-cols-6">
                                <div class="col-span-2">Request Number: </div>
                                <div id="req_number" class="col-span-4 font-semibold text-lg"></div>

                                <div class="col-span-2">Date: </div>
                                <div id="event_date" class="col-span-4 font-semibold text-lg"></div>

                                <div class="col-span-2">Venue: </div>
                                <div id="venue" class="col-span-4 font-semibold text-lg"></div>

                                <div class="col-span-2">Trainer: </div>
                                <div id="trainer" class="col-span-4 font-semibold text-lg"></div>

                                <div class="col-span-2">Status: </div>
                                <div id="status" class="col-span-4 font-semibold text-lg"></div>
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

                                    <div id="cp2_div" class="col-span-6 grid grid-cols-6">
                                        <div class="ml-10 mt-5 col-span-2">Name: </div>
                                        <div id="cp2_name" class="col-span-4 font-semibold text-lg mt-5"></div>
                                        <div class="ml-10 col-span-2">Date: </div>
                                        <div id="cp2_number" class="col-span-4 font-semibold text-lg"></div>
                                        <div class="ml-10 col-span-2">E-mail: </div>
                                        <div id="cp2_email" class="col-span-4 font-semibold text-lg"></div>
                                    </div>

                                    <div id="cp3_div" class="col-span-6 grid grid-cols-6">
                                        <div class="ml-10 mt-5 col-span-2">Name: </div>
                                        <div id="cp3_name" class="col-span-4 font-semibold text-lg mt-5"></div>
                                        <div class="ml-10 col-span-2">Date: </div>
                                        <div id="cp3_number" class="col-span-4 font-semibold text-lg"></div>
                                        <div class="ml-10 col-span-2">E-mail: </div>
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
                                    <div id="area" class="col-span-4 font-semibold text-lg">NORTH</div>
                                    <div class="col-span-2">Category: </div>
                                    <div id="category" class="col-span-4 font-semibold text-lg">CHARGEABLE</div>
                                    <div id="con_details_div" class="col-span-6 grid grid-cols-6">
                                        <div class="col-span-2">Contract Details: </div>
                                        <a href="#" id="contract_details" target="_blank" class="col-span-4 font-semibold text-lg text-white bg-blue-500 rounded-lg w-40 tracking-wide text-center hover:scale-105">VIEW</a>
                                    </div>
                                    <div class="col-span-2">Brand: </div>
                                    <div id="brand" class="col-span-4 font-semibold text-lg">CHARGEABLE</div>
                                    <div class="col-span-2">Model: </div>
                                    <div id="model" class="col-span-4 font-semibold text-lg">CHARGEABLE</div>
                                    <div class="col-span-2">Type of Unit: </div>
                                    <div id="unit_type" class="col-span-4 font-semibold text-lg">RENTAL UNIT</div>
                                    <div class="col-span-2">Billing Type: </div>
                                    <div id="billing_type" class="col-span-4 font-semibold text-lg">CHARGEABLE</div>
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
                        <div class="px-4 col-span-2 h-full overflow-x-hidden overflow-y-auto">
                            <div class="relative">
                                <div class="sticky top-0 bg-white py-2">
                                    <div class="flex items-center mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="h-6 w-6"><path d="M477-120q-149 0-253-105.5T120-481h60q0 125 86 213t211 88q127 0 215-89t88-216q0-124-89-209.5T477-780q-68 0-127.5 31T246-667h105v60H142v-208h60v106q52-61 123.5-96T477-840q75 0 141 28t115.5 76.5Q783-687 811.5-622T840-482q0 75-28.5 141t-78 115Q684-177 618-148.5T477-120Zm128-197L451-469v-214h60v189l137 134-43 43Z"/></svg>
                                        <h3 class="ml-1">History Logs</h3>
                                    </div>
                                    <hr>
                                </div>
                                <div id="logsDiv">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="cancelButton" data-modal-target="confirmCancelModal" data-modal-toggle="confirmCancelModal" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">CANCEL SCHEDULE</button>
                        <button id="rescheduleButton" data-modal-target="rescheduleModal" data-modal-toggle="rescheduleModal" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">RESCHEDULE</button>
                        <button data-modal-hide="viewRequestModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- VIEW EVENT MODAL END --}}

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="bg-white shadow-xl rounded-lg p-3 h-full">
            <div class="overflow-hidden rounded-lg p-4">
                {{-- CONTROLS --}}
                    @csrf
                    <div class="mb-3">
                        <div class="flex flex-row-reverse">
                            {{-- <div class="w-24 mb-3 md:mb-0">
                                <a href="{{ route('request.add') }}" class="flex justify-center items-center text-white bg-blue-600 hover:scale-105 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm py-2 focus:outline-none mt-px">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition duration-75 mr-1" fill="currentColor" viewBox="0 -960 960 960"><path d="M440.391-190.391v-250h-250v-79.218h250v-250h79.218v250h250v79.218h-250v250h-79.218Z"/></svg>
                                    <span>ADD</span></a>
                            </div> --}}
                            <div class="justify-self-end w-full xl:w-2/5">
                                <form method="POST" action="{{ route('request.search') }}" id="searchForm" class="w-full">
                                    @csrf
                                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <input type="search" id="search" name="search" class="block z-10 w-full px-4 py-2.5 pl-10 text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="SEARCH" value="{{ $search }}" autocomplete="off">
                                        <button id="clearButton" type="button" class="absolute right-20 bottom-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition duration-75 group-hover:text-gray-900 mr-1 text-gray-500" fill="currentColor" viewBox="0 -960 960 960"><path d="M249-193.434 193.434-249l231-231-231-231L249-766.566l231 231 231-231L766.566-711l-231 231 231 231L711-193.434l-231-231-231 231Z"/></svg>
                                        </button>
                                        <button id="searchSubmit" type="submit" style="bottom: 5px; right: 5px;" type="submit" class="text-white absolute bg-blue-600 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {{-- CONTROLS END --}}

                <div>
                    {{-- TABLE --}}
                        <div class="hidden md:block">
                            <div id="inventoryTable" class="overflow-auto w-full shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-600 uppercase bg-gray-100">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Action
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Company Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Area
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Trainer
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Last Updated
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requests as $request)
                                            @php
                                                if($request->status == 'SCHEDULED'){
                                                    $sColor = 'text-orange-500';
                                                }else if($request->status == 'COMPLETED'){
                                                    $sColor = 'text-emerald-600';
                                                }else if($request->status == 'CANCELLED'){
                                                    $sColor = 'text-red-600';
                                                }
                                            @endphp
                                            <tr class="requestRow bg-white border-b cursor-pointer hover:bg-gray-200 even:bg-gray-100">
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if ($request->status == 'SCHEDULED')
                                                        <a href="{{ url('/trainings/edit/'.$request->key) }}" class="editButton text-blue-600 hover:underline font-semibold text-sm">Edit</a>
                                                    @endif
                                                     {{-- | <button type="button" data-modal-target="confirmDeleteModal" data-modal-toggle="confirmDeleteModal" data-key="{{ $request->key }}" class="deleteButton text-red-600 hover:underline font-semibold text-sm cursor-pointer">Delete</button> --}}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ date('F j, Y', strtotime($request->training_date)) }}
                                                </td>
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    <span data-key="{{ $request->key }}">
                                                        {{ $request->name }}
                                                    </span>
                                                </th>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $request->area }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $request->first_name.' '.$request->last_name }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap {{ $sColor }} font-semibold">
                                                    {{ $request->status }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ date('F j, Y', strtotime($request->updated_at)) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    {{-- TABLE END --}}

                    {{-- INVENTORY LIST SMALL DEVICE --}}
                        <div class="overflow-auto md:hidden">
                            <div id="accordion-collapse" data-accordion="collapse">
                                @php
                                    $x = 1;
                                @endphp
                                @foreach ($requests as $request)
                                    @php
                                        if($request->status == 'SCHEDULED'){
                                            $sColor = 'text-orange-500';
                                        }else if($request->status == 'COMPLETED'){
                                            $sColor = 'text-emerald-600';
                                        }else if($request->status == 'CANCELLED'){
                                            $sColor = 'text-red-600';
                                        }
                                    @endphp
                                    <h2 id="accordion-collapse-heading-{{$x}}">
                                        <button type="button" class="flex items-center justify-between w-full px-3 py-1.5 text-sm font-semibold text-left text-gray-500 border  border-gray-200 {{ $x == 1 ? 'rounded-t-xl border-b-0' : 'border-b' }} hover:bg-gray-100 focus:bg-gray-900" data-accordion-target="#accordion-collapse-body-{{$x}}" aria-expanded="false" aria-controls="accordion-collapse-body-{{$x}}">
                                            <span>{{ $request->name }}</span>
                                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </h2>
                                    <div id="accordion-collapse-body-{{$x}}" class="hidden" aria-labelledby="accordion-collapse-heading-{{$x}}">
                                        <div class="px-3 py-1.5 font-light border border-b border-gray-200">
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Date</div>
                                                <div class=" font-semibold text-sm">
                                                    {{ date('F j, Y', strtotime($request->training_date)) }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Area</div>
                                                <div class=" font-semibold text-sm">
                                                    {{ $request->area }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Trainer</div>
                                                <div class="font-semibold text-sm">
                                                    {{ $request->first_name.' '.$request->last_name }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Status</div>
                                                <div class="text-sm {{ $sColor }} font-semibold">
                                                    {{ $request->status }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Action</div>
                                                <div class="">
                                                    @if ($request->status == 'SCHEDULED')
                                                        <a href="{{ url('/trainings/edit/'.$request->key) }}" class="text-blue-600 hover:underline font-semibold text-sm">Edit</a>
                                                    @endif
                                                     {{-- | 
                                                     <button type="button" data-modal-target="confirmDeleteModal" data-modal-toggle="confirmDeleteModal" data-key="{{ $request->key }}" class="deleteButton text-red-600 hover:underline font-semibold text-sm">Delete</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $x++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                    {{-- INVENTORY LIST SMALL DEVICE END --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var key = '';

            $('.requestRow').on('click', '.editButton', function(e) {
                e.stopPropagation();
            });

            $('.requestRow').on('click', '.deleteButton', function(e) {
                e.stopPropagation();
            });

            $(document).click(function(){
                $('#alert-3').addClass('opacity-0');
                setTimeout(function() {
                    $('#notifCloseButton').click();
                }, 550);
            });

            $('.requestRow').click(function(){
                key = $(this).find('span').data('key');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('trainings.view') }}",
                    method:"POST",
                    dataType: 'json',
                    data:{
                        key: key,
                        _token: _token
                    },
                    success:function(result){
                        $('#req_number').html(result.req_number);
                        var currentDate = new Date();
                        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
                        var day = currentDate.getDate().toString().padStart(2, '0');
                        var year = currentDate.getFullYear().toString();
                        var nCurDate = month + '/' + day + '/' + year;
                        var nCCDate = year + "-" + month + "-" + day;

                        var dateParts = result.event_date.split('/');
                        var eventDate = dateParts[2] + '-' + dateParts[0] + '-' + dateParts[1];

                        $('#event_date').html(result.event_date);
                        $('#reschedKey').val(result.key)

                        if(eventDate < nCCDate){
                            $('#rescheduleDate').val(nCurDate);
                        }else{
                            $('#rescheduleDate').val(result.event_date);
                        }

                        $('#venue').html(result.venue);
                        $('#trainer').html(result.trainer);
                        $('#status').html(result.status);

                        $('#status').removeClass('text-orange-500');
                        $('#status').removeClass('text-emerald-600');
                        $('#status').removeClass('text-red-600');
                        $('#cancelButton').addClass('hidden');
                        $('#rescheduleButton').addClass('hidden');
                        if(result.status == 'SCHEDULED'){
                            $('#cancelButton').removeClass('hidden');
                            $('#status').addClass('text-orange-500');
                        }else if(result.status == 'COMPLETED'){
                            $('#status').addClass('text-emerald-600');
                        }else if(result.status == 'CANCELLED'){
                            $('#status').addClass('text-red-600');
                            $('#rescheduleButton').removeClass('hidden');
                        }

                        $('#name').html(result.name);
                        $('#address').html(result.address);

                        if(result.cp1_name != ''){
                            $('#cp1_name').html(result.cp1_name);
                            $('#cp1_number').html(result.cp1_number);
                            $('#cp1_email').html(result.cp1_email);
                            $('#cp1_div').removeClass('hidden');
                        }else{
                            $('#cp1_div').addClass('hidden');
                        }

                        if(result.cp2_name != ''){
                            $('#cp2_name').html(result.cp2_name);
                            $('#cp2_number').html(result.cp2_number);
                            $('#cp2_email').html(result.cp2_email);
                            $('#cp2_div').removeClass('hidden');
                        }else{
                            $('#cp2_div').addClass('hidden');
                        }

                        if(result.cp3_name != ''){
                            $('#cp3_name').html(result.cp3_name);
                            $('#cp3_number').html(result.cp3_number);
                            $('#cp3_email').html(result.cp3_email);
                            $('#cp3_div').removeClass('hidden');
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

                        $('#logsDiv').html(result.logRes);
                        
                        $('#viewRequestButton').click();
                        autoResize();
                    }
                })
            });

            function autoResize() {
                var textarea = $('#remarks');
                textarea.css('height', 'auto');
                textarea.css('height', textarea[0].scrollHeight + 'px');
            }

            $('.deleteButton').click(function(){
                key = $(this).data('key');
            });

            $('#confirmDeleteButton').click(function(){
                window.location.href = `/request/delete/${key}`;
            });

            $('#clearButton').click(function(){
                $('#search').val('');
                $('#searchSubmit').click();
            });

            $('#confirmCancelButtona').click(function(){
                window.location.href = `/training/cancel/${key}`;
            });

            $(document).on('click', '.datepicker-cell', function() {
                var enteredDate = new Date($('#rescheduleDate').val());
                var currentDate = new Date();
                if (enteredDate < currentDate) {
                    var formattedDate = moment(currentDate).format('MM/DD/YYYY');
                    $('#rescheduleDate').val(formattedDate);
                }
            });
        });
    </script>
@endsection
