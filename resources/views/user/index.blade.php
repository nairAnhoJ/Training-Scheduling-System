@extends('layouts.app')
@section('title','SCHEDULE BOARD')
@section('content')

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


    {{-- ADD EVENT MODAL --}}
        <!-- Modal toggle -->
        <button data-modal-target="addEventModal" data-modal-toggle="addEventModal" id="addEventButton" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button"></button>
        
        <!-- Main modal -->
        <div id="addEventModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full max-h-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0">
            <div class="relative w-full max-w-3xl overflow-x-hidden overflow-y-auto bg-white border border-gray-300 rounded-lg shadow-xl">
                <!-- Modal content -->
                <form action="{{ route('event.add') }}" method="POST" class="relative text-gray-700 shadow">
                    @csrf
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="flex items-center text-xl font-semibold tracking-wide text-gray-900">ADD EVENT</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="addEventModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        <div class="mb-6">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <input type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" autocomplete="off" required>
                        </div>
                        <div class="mb-6">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input datepicker type="text" id="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date" autocomplete="off" required>
                            </div>    
                        </div>
                        <div class="mb-6">
                            <label for="tr" class="block text-sm font-semibold text-gray-600">Trainer</label>
                            <select id="tr" name="trainer" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="0">All</option>
                                @foreach ($trainers as $trainer)
                                    <option value="{{$trainer->id}}">{{$trainer->first_name.' '.$trainer->last_name}}</span></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">SAVE</button>
                        <button id="closeConfirmApproveButton" data-modal-hide="addEventModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- ADD EVENT MODAL END --}}

    {{-- COMPLETE MODAL --}}
        <!-- Main modal -->
        <div id="completeModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-xl overflow-x-hidden overflow-y-auto bg-white border-2 border-gray-300 rounded-lg shadow-2xl">
                <!-- Modal content -->
                <div class="relative text-gray-700 shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="flex items-center text-xl font-semibold tracking-wide text-gray-900">MARK AS COMPLETED</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="completeModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        Are you sure you want to mark this training as completed?
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="confirmCompleteButton" type="button" class="text-white bg-emerald-500 hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">YES</button>
                        <button id="closeConfirmApproveButton" data-modal-hide="completeModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- COMPLETE MODAL END --}}

    {{-- EXTEND MODAL --}}
        <!-- Main modal -->
        <div id="extendModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-xl overflow-x-hidden overflow-y-auto bg-white border-2 border-gray-300 rounded-lg shadow-2xl">
                <!-- Modal content -->
                <div class="relative text-gray-700 shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="flex items-center text-xl font-semibold tracking-wide text-gray-900">EXTEND TRAINING</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="extendModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        Are you sure you want to extend this training?
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="confirmExtendButton" type="button" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">YES</button>
                        <button id="closeConfirmApproveButton" data-modal-hide="extendModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- EXTEND MODAL END --}}

    {{-- CANCEL MODAL --}}
        <!-- Main modal -->
        <div id="confirmCancelModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-xl overflow-x-hidden overflow-y-auto bg-white border-2 border-gray-300 rounded-lg shadow-2xl">
                <!-- Modal content -->
                <div class="relative text-gray-700 shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="flex items-center text-xl font-semibold tracking-wide text-gray-900">CANCEL TRAINING</h3>
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
                        <button id="confirmCancelButton" type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">CANCEL</button>
                        <button id="closeConfirmApproveButton" data-modal-hide="confirmCancelModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- CANCEL MODAL END --}}

    {{-- VIEW CUSTOM EVENT MODAL --}}
        <!-- Modal toggle -->
        <button data-modal-target="viewCustomModal" data-modal-toggle="viewCustomModal" id="viewCustomEventButton" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button"></button>
        
        <!-- Main modal -->
        <div id="viewCustomModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-3xl overflow-x-hidden overflow-y-auto bg-white border border-gray-300 rounded-lg shadow-xl">
                <!-- Modal content -->
                <div class="relative text-gray-700 shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 id="cusName" class="flex items-center text-xl font-semibold tracking-wide text-gray-900"></h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="viewCustomModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        <div class="grid grid-cols-6 gap-y-3">
                            <div class="col-span-2">Date: </div>
                            <div id="cusDate" class="col-span-4 text-lg font-semibold"></div>

                            <div class="col-span-2">Trainer: </div>
                            <div id="cusTrainer" class="col-span-4 text-lg font-semibold"></div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="deleteCustomButton" type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">DELETE</button>
                        <button id="closeConfirmApproveButton" data-modal-hide="viewCustomModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- VIEW CUSTOM EVENT MODAL END --}}

    {{-- VIEW EVENT MODAL --}}
        <!-- Modal toggle -->
        <button data-modal-target="viewEventModal" data-modal-toggle="viewEventModal" id="viewEventButton" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
            Toggle modal
        </button>
        
        <!-- Main modal -->
        <div id="viewEventModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full h-full overflow-x-hidden overflow-y-auto bg-white rounded-lg">
                <!-- Modal content -->
                <div class="relative text-gray-700 shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 bg-blue-500 border-b rounded-t">
                        <h3 id="name" class="flex items-center text-xl font-semibold tracking-wide text-gray-900"></h3>
                        <button type="button" class="closeViewEventModalButton text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="viewEventModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 overflow-y-hidden overflow-x-hidden h-[calc(100vh-220px)]">
                        <div class="grid grid-cols-3">
                            <div class="col-span-2 border-r pr-6 overflow-y-auto overflow-x-hidden h-[calc(100vh-268px)]">
                                <div class="grid grid-cols-6">
                                    <div class="col-span-2">Status: </div>
                                    <div id="status" class="col-span-4 text-lg font-semibold"></div>
    
                                    <div class="col-span-2">Date: </div>
                                    <div id="event_date" class="col-span-4 text-lg font-semibold"></div>
    
                                    <div class="col-span-2">Venue: </div>
                                    <div id="venue" class="col-span-4 text-lg font-semibold"></div>
    
                                    <div class="col-span-2">Trainer: </div>
                                    <div id="trainer" class="col-span-4 text-lg font-semibold"></div>
    
                                    <div class="col-span-2">Training Number: </div>
                                    <div id="trainingNumber" class="col-span-4 text-lg font-semibold"></div>
                                </div>
    
                                <div class="mt-5">
                                    <div class="flex items-center">
                                        <h1 class="mr-3 text-xl font-bold tracking-wider text-gray-700 whitespace-nowrap">CUSTOMER DETAILS</h1><hr class="w-full border-gray-500 whitespace-nowrap">
                                    </div>
                                    <div class="grid grid-cols-6">
                                        <div class="col-span-2">Address: </div>
                                        <div id="address" class="col-span-4 text-lg font-semibold"></div>
    
                                        <h3 class="col-span-6 font-semibold">Contact Person/s:</h3>
                                        <div id="cp1_div" class="grid grid-cols-6 col-span-6">
                                            <div class="col-span-2 ml-10">Name: </div>
                                            <div id="cp1_name" class="col-span-4 text-lg font-semibold"></div>
                                            <div class="col-span-2 ml-10">Date: </div>
                                            <div id="cp1_number" class="col-span-4 text-lg font-semibold"></div>
                                            <div class="col-span-2 ml-10">E-mail: </div>
                                            <div id="cp1_email" class="col-span-4 text-lg font-semibold"></div>
                                        </div>
    
                                        <div id="cp2_div" class="grid grid-cols-6 col-span-6">
                                            <div class="col-span-2 mt-5 ml-10">Name: </div>
                                            <div id="cp2_name" class="col-span-4 mt-5 text-lg font-semibold"></div>
                                            <div class="col-span-2 ml-10">Date: </div>
                                            <div id="cp2_number" class="col-span-4 text-lg font-semibold"></div>
                                            <div class="col-span-2 ml-10">E-mail: </div>
                                            <div id="cp2_email" class="col-span-4 text-lg font-semibold"></div>
                                        </div>
    
                                        <div id="cp3_div" class="grid grid-cols-6 col-span-6">
                                            <div class="col-span-2 mt-5 ml-10">Name: </div>
                                            <div id="cp3_name" class="col-span-4 mt-5 text-lg font-semibold"></div>
                                            <div class="col-span-2 ml-10">Date: </div>
                                            <div id="cp3_number" class="col-span-4 text-lg font-semibold"></div>
                                            <div class="col-span-2 ml-10">E-mail: </div>
                                            <div id="cp3_email" class="col-span-4 text-lg font-semibold"></div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="mt-5">
                                    <div class="flex items-center">
                                        <h1 class="mr-3 text-xl font-bold tracking-wider text-gray-700 whitespace-nowrap">OTHER DETAILS</h1><hr class="w-full border-gray-500 whitespace-nowrap">
                                    </div>
                                    <div class="grid grid-cols-6">
                                        <div class="col-span-2">Area: </div>
                                        <div id="area" class="col-span-4 text-lg font-semibold"></div>
                                        <div class="col-span-2">Category: </div>
                                        <div id="category" class="col-span-4 text-lg font-semibold"></div>
                                        <div id="con_details_div" class="grid grid-cols-6 col-span-6">
                                            <div class="col-span-2">Contract Details: </div>
                                            <a href="#" id="contract_details" target="_blank" class="w-40 col-span-4 text-lg font-semibold tracking-wide text-center text-white bg-blue-500 rounded-lg hover:scale-105">VIEW</a>
                                        </div>
                                        <div class="col-span-2">Brand: </div>
                                        <div id="brand" class="col-span-4 text-lg font-semibold"></div>
                                        <div class="col-span-2">Model: </div>
                                        <div id="model" class="col-span-4 text-lg font-semibold"></div>
                                        <div class="col-span-2">Type of Unit: </div>
                                        <div id="unit_type" class="col-span-4 text-lg font-semibold"></div>
                                        <div class="col-span-2">Billing Type: </div>
                                        <div id="billing_type" class="col-span-4 text-lg font-semibold"></div>
                                        <div class="col-span-2">Number of Attendees: </div>
                                        <div id="no_of_attendees" class="col-span-4 text-lg font-semibold">13</div>
                                        <div class="col-span-2">Knowledge of Participants: </div>
                                        <div id="knowledge_of_participants" class="col-span-4 text-lg font-semibold"></div>
                                        {{-- <div class="col-span-2">Notes: </div>
                                        <div class="col-span-4 font-semibold">
                                            <textarea id="remarks" class="w-full p-0 text-lg border-0 cursor-default resize-none ring-0 focus:ring-0" readonly></textarea>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="pl-6">
                                <h1 class="text-2xl font-bold">Comments</h1>
                                <div id="commentContainer" class="h-[calc(100vh-358px)] overflow-x-hidden overflow-y-auto pr-2">
                                </div>
                                <div class="h-[40px] pr-2 mt-2">
                                    <div>
                                        <div>   
                                            <label for="commentInput" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                                            <div class="relative">
                                                <input type="text" id="commentInput" name="commentInput" class="block w-full pl-4 text-sm text-gray-900 border border-gray-300 rounded-full h-14 pr-14 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Write a comment..." required>
                                                <button type="button" id="commentSubmit" class="text-white absolute right-2.5 bottom-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-2 py-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="currentColor"><path d="M120-160v-640l760 320-760 320Zm60-93 544-227-544-230v168l242 62-242 60v167Zm0 0v-457 457Z"/></svg></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="completeButton" data-modal-target="completeModal" data-modal-toggle="completeModal" class="text-white bg-emerald-500 hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">MARK AS COMPLETED</button>
                        <button id="extendButton" data-modal-target="extendModal" data-modal-toggle="extendModal" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">EXTEND SCHEDULE</button>
                        <button id="cancelButton" data-modal-target="confirmCancelModal" data-modal-toggle="confirmCancelModal" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">CANCEL SCHEDULE</button>
                        <button data-modal-hide="viewEventModal" type="button" class="closeViewEventModalButton text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- VIEW EVENT MODAL END --}}

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="h-full py-5 pl-5 pr-8 overflow-y-scroll bg-white rounded-lg shadow-xl">
            <div class="">
                <div class="grid w-full grid-cols-1 lg:grid-cols-3 gap-x-5">

                    <div class="shadow-[0_0px_5px_1px_rgb(0,0,0,0.15)] rounded-lg overflow-hidden mb-5">
                        <div class="flex items-center w-full h-full">
                            <div class="h-24">
                                <div class="flex items-center justify-center w-24 h-full bg-emerald-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white transition duration-75 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path xmlns="http://www.w3.org/2000/svg" d="M433-228 295-365l42-42 96 94 184-184 42 43-226 226ZM180-80q-24 0-42-18t-18-42v-620q0-24 18-42t42-18h65v-60h65v60h340v-60h65v60h65q24 0 42 18t18 42v620q0 24-18 42t-42 18H180Zm0-60h600v-430H180v430Zm0-490h600v-130H180v130Zm0 0v-130 130Z"/></svg>
                                </div>
                            </div>
                            <div class="w-full px-5">
                                <div class="flex justify-between w-full">
                                    <div class="flex flex-col justify-center">
                                        <h1 class="text-3xl font-semibold">{{$trainingCount}}</h1>
                                        <h1 class="text-sm lg:text-xs 2xl:text-sm">Upcoming Trainings</h1>
                                    </div>
                                    <div class="flex items-center">
                                        <a href="{{ route('trainings.index') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500 transition duration-75 hover:text-gray-600 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path xmlns="http://www.w3.org/2000/svg" d="M686-450H160v-60h526L438-758l42-42 320 320-320 320-42-42 248-248Z"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="shadow-[0_0px_5px_1px_rgb(0,0,0,0.15)] rounded-lg overflow-hidden mb-5">
                        <div class="flex items-center w-full h-full">
                            <div class="h-24">
                                <div class="flex items-center justify-center w-24 h-full bg-amber-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white transition duration-75 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path xmlns="http://www.w3.org/2000/svg" d="m800-134 28-28-75-75v-112h-40v128l87 87Zm-620 14q-24.75 0-42.375-17.625T120-180v-600q0-24.75 17.625-42.375T180-840h600q24.75 0 42.375 17.625T840-780v329q-14-8-29.5-13t-30.5-8v-308H180v600h309q4 16 9.023 31.172Q503.045-133.655 510-120H180Zm0-107v47-600 308-4 249Zm100-53h211q4-16 9-31t13-29H280v60Zm0-170h344q14-7 27-11.5t29-8.5v-40H280v60Zm0-170h400v-60H280v60ZM732.5-41Q655-41 600-96.5T545-228q0-78.435 54.99-133.717Q654.98-417 733-417q77 0 132.5 55.283Q921-306.435 921-228q0 76-55.5 131.5T732.5-41Z"/></svg>
                                </div>
                            </div>

                            <div class="w-full px-5">
                                <div class="flex justify-between w-full">
                                    <div class="flex flex-col justify-center">
                                        <h1 class="text-3xl font-semibold">{{$requestCount}}</h1>
                                        <h1 class="text-sm lg:text-xs 2xl:text-sm">Pending Request</h1>
                                    </div>
                                    <div class="flex items-center">
                                        <a href="{{ route('request.index') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500 transition duration-75 hover:text-gray-600 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path xmlns="http://www.w3.org/2000/svg" d="M686-450H160v-60h526L438-758l42-42 320 320-320 320-42-42 248-248Z"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="shadow-[0_0px_5px_1px_rgb(0,0,0,0.15)] rounded-lg overflow-hidden mb-5">
                        <div class="flex items-center">
                            <div class="h-24">
                                <div class="flex items-center justify-center w-24 h-full bg-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white transition duration-75 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path d="M349-250h262q12.75 0 21.375-8.675 8.625-8.676 8.625-21.5 0-12.825-8.625-21.325T611-310H349q-12.75 0-21.375 8.675-8.625 8.676-8.625 21.5 0 12.825 8.625 21.325T349-250Zm0-170h262q12.75 0 21.375-8.675 8.625-8.676 8.625-21.5 0-12.825-8.625-21.325T611-480H349q-12.75 0-21.375 8.675-8.625 8.676-8.625 21.5 0 12.825 8.625 21.325T349-420ZM220-80q-24 0-42-18t-18-42v-680q0-24 18-42t42-18h336q12.444 0 23.722 5T599-862l183 183q8 8 13 19.278 5 11.278 5 23.722v496q0 24-18 42t-42 18H220Zm331-584v-156H220v680h520v-494H581q-12.75 0-21.375-8.625T551-664ZM220-820v186-186 680-680Z"/></svg>
                                </div>
                            </div>

                            <div class="w-full px-5">
                                <div class="flex justify-between w-full">
                                    <div class="flex flex-col justify-center">
                                        <h1 class="text-3xl font-semibold">0</h1>
                                        <h1 class="text-sm lg:text-xs 2xl:text-sm">Pending Request From Customer</h1>
                                    </div>
                                    <div class="flex items-center">
                                        <a href="{{ route('customer.request.index') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500 transition duration-75 hover:text-gray-600 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path xmlns="http://www.w3.org/2000/svg" d="M686-450H160v-60h526L438-758l42-42 320 320-320 320-42-42 248-248Z"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- Legends --}}
            <div class="flex w-full gap-x-5">
                <span class="flex items-center text-sm font-bold text-gray-900 uppercase">
                    <span class="flex w-3 h-3 bg-[#FE2C55] rounded-full mr-1.5 flex-shrink-0"></span>
                    ALL
                </span>
                @foreach ($trainers as $trainer)
                    <span class="flex items-center text-sm font-bold text-gray-900 uppercase">
                        <span class="flex w-3 h-3 bg-[{{ $trainer->color }}] rounded-full mr-1.5 flex-shrink-0"></span>
                        {{ $trainer->first_name.' '.$trainer->last_name }}
                    </span>
                @endforeach
            </div>
    
            <div id="calendar" class="mt-3"></div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var id;
            var role = '{{ $role }}';
            var eventArray = @json($eventArray);

            var headerConfig = {
                center: 'title',
                right: 'prev,next today'
            };

            if (role == 1 || role == 0) {
                headerConfig.left = 'AddEvent';
            }

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: headerConfig,
                customButtons: {
                    AddEvent: {
                        text: 'Add Event',
                        classNames: 'myButtonClass',
                        click: function() {
                            $('#addEventButton').click();
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
                    $('#loading').toggleClass('hidden');
                    id = calEvent.event.id;
                    var isTraining = calEvent.event.extendedProps.isTraining;
                    var _token = $('input[name="_token"]').val();
                    console.log(calEvent.event.extendedProps.notificationCount);

                    if(isTraining){
                        $.ajax({
                            url:"{{ route('dashboard.view') }}",
                            method:"POST",
                            dataType: 'json',
                            data:{
                                id: id,
                                _token: _token
                            },
                            success:function(result){
                                $('#status').html(result.status);

                                $('#status').removeClass('text-orange-500');
                                $('#status').removeClass('text-emerald-600');
                                $('#status').removeClass('text-red-600');
                                if(result.status == 'SCHEDULED'){
                                    $('#status').addClass('text-orange-500');
                                    $('#cancelButton').removeClass('hidden');
                                }else if(result.status == 'COMPLETED'){
                                    $('#status').addClass('text-emerald-600');
                                    $('#completeButton').addClass('hidden');
                                    $('#extendButton').addClass('hidden');
                                    $('#cancelButton').addClass('hidden');
                                }else if(result.status == 'CANCELLED'){
                                    $('#status').addClass('text-red-600');
                                    $('#completeButton').addClass('hidden');
                                    $('#extendButton').addClass('hidden');
                                    $('#cancelButton').addClass('hidden');
                                }

                                var nnndate = new Date(result.end_date);
                                var cccdate = new Date();

                                if(nnndate > cccdate){
                                    $('#completeButton').addClass('hidden');
                                    $('#extendButton').addClass('hidden');
                                }

                                $('#event_date').html(result.event_date);
                                $('#venue').html(result.venue);
                                $('#trainer').html(result.trainer);
                                $('#trainingNumber').html(result.training_number);
                                if(result.event_date != '' && result.venue != '' && result.trainer != '' && result.event_date != null && result.venue != null && result.trainer != null){
                                    $('#approveButton').prop('disabled', false);
                                    // $('#approveButton').attr('href', `/request/approve/${result.key}`);
                                }else{
                                    $('#approveButton').prop('disabled', 'true');
                                }

                                $('#name').html(result.name);
                                $('#address').html(result.address);

                                if(result.cp1_name != ''){
                                    $('#cp1_div').removeClass('hidden');
                                    $('#cp1_name').html(result.cp1_name);
                                    $('#cp1_number').html(result.cp1_number);
                                    $('#cp1_email').html(result.cp1_email);
                                }else{
                                    $('#cp1_div').addClass('hidden');
                                }

                                if(result.cp2_name != ''){
                                    $('#cp2_div').removeClass('hidden');
                                    $('#cp2_name').html(result.cp2_name);
                                    $('#cp2_number').html(result.cp2_number);
                                    $('#cp2_email').html(result.cp2_email);
                                }else{
                                    $('#cp2_div').addClass('hidden');
                                }

                                if(result.cp3_name != ''){
                                    $('#cp3_div').removeClass('hidden');
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

                                $('#commentContainer').html(result.com);
                                $('#commentInput').val('');
                                $('#commentInput').focus();

                                $('#loading').toggleClass('hidden');
                                $('#viewEventButton').click();
                                autoScroll();
                            }
                        })
                    }else{
                        $.ajax({
                            url:"{{ route('event.view') }}",
                            method:"POST",
                            dataType: 'json',
                            data:{
                                id: id,
                                _token: _token
                            },
                            success:function(result){
                                $('#cusName').html(result.description);
                                $('#cusDate').html(result.date);
                                $('#cusTrainer').html(result.trainer);
                                
                                $('#loading').toggleClass('hidden');
                                $('#viewCustomEventButton').click();
                            }
                        })
                    }
                },
                events: eventArray,
                eventDidMount: function(calEvent) {
                    console.log(calEvent.event);
                    $('.fc-event-title-container').css('padding-right', '13px');
                    // var eventTitleElement = calEvent.el.querySelector('.fc-title');
                    // eventTitleElement.addClass()
                    var event = calEvent.event;
                    if (event.extendedProps.notificationCount > 0) {
                        var badge = document.createElement('div');
                        badge.className = 'absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 bg-red-500 text-white w-5 h-5 rounded-full flex items-center justify-center text-xs font-semibold';
                        badge.textContent = event.extendedProps.notificationCount;
                        calEvent.el.appendChild(badge);
                    }
                }
            });
            calendar.render();

            $('.fc-addButton-button').removeClass('fc-button-primary fc fc-button');
            $('.fc-addButton-button').addClass('bg-blue-500 font-bold h-10 px-10 rounded-lg text-white tracking-wider hover:scale-105');
            $('.fc-event-title').addClass('text-black font-medium');
            
            function autoScroll() {
                var commentList = $('#commentContainer');
                var scrollHeight = commentList[0].scrollHeight;
                commentList.scrollTop(scrollHeight);
            }

            $('#deleteCustomButton').click(function(){
                window.location.href = `/schedule-board/event/delete/${id}`;
            });

            $('#confirmExtendButton').click(function(){
                window.location.href = `/schedule-board/extend/${id}`;
            });

            $('#confirmCompleteButton').click(function(){
                window.location.href = `/schedule-board/complete/${id}`;
            });

            $('#confirmCancelButton').click(function(){
                window.location.href = `/schedule-board/cancel/${id}`;
            });

            $('input').keypress(function(event) {
                if (event.which === 13) {
                    submitComment();
                }
            });

            $('#commentSubmit').click(function(){
                submitComment();
            });

            $('.closeViewEventModalButton').click(function(){
                location.reload();
            });

            function submitComment(){
                var content = $('#commentInput').val();
                var _token = $('input[name="_token"]').val();
                
                if(content != '' && content != null){
                    $.ajax({
                        url:"{{ route('comment.store') }}",
                        method:"POST",
                        data:{
                            id: id,
                            content: content,
                            _token: _token
                        },
                        success:function(result){
                            $('#commentContainer').html(result);
                            $('#commentInput').val('');
                            $('#commentInput').focus();
                            autoScroll();
                        }
                    })
                }
            }
        });
    </script>
@endsection
