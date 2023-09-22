@extends('layouts.app')
@section('title','REQUESTS FROM CUSTOMERS')
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

    {{-- APPROVE MODAL --}}
        <!-- Main modal -->
        <div id="confirmApproveModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full overflow-x-hidden overflow-y-auto bg-white border border-gray-300 rounded-lg shadow-xl">
                <!-- Modal content -->
                <form action="{{ route('customer.request.approve') }}" method="POST" class="relative text-gray-700 shadow">
                    @csrf
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="flex items-center text-xl font-semibold tracking-wide text-gray-900">APPROVE</h3>
                        <button type="button" class="closeConfirmApproveButton text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="confirmApproveModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        <h1 class="mb-2 text-xl font-bold text-gray-600">COMPANY DETAILS</h1>
                        <input type="hidden" id="inputID" name="id">
                        <input type="hidden" id="inputCategory" name="category">
                        <input type="hidden" id="inputBrand" name="brand">
                        <input type="hidden" id="inputModel" name="model">
                        <input type="hidden" id="inputUnitType" name="unit_type">
                        <input type="hidden" id="inputNoUnit" name="no_of_unit">
                        <input type="hidden" id="inputNoAttendees" name="no_of_attendees">
                        <input type="hidden" id="inputKnowledge" name="knowledge_of_participants">

                        <div class="grid grid-cols-2 overflow-y-auto overflow-x-hidden h-[calc(100vh-330px)]">
                            <div class="pr-10 border-r">
                                <div class="">
                                    <div class="relative flex flex-col mb-3 optionDiv">
                                        <label for="inputName" class="block text-sm font-semibold text-gray-600">Company Name <span class="text-red-500">*</span></label>
                                        <input type="text" id="inputName" name="name" class="inputOption block w-full p-2.5 text-gray-600 border border-gray-300 rounded-lg bg-gray-50 sm:text-sm" required autocomplete="off">
                                        <div class="listOption hidden absolute top-[62px] w-full rounded-lg border-x border-b border-gray-300 overflow-y-auto max-h-[30vh] text-gray-600 bg-white z-[99] shadow-xl">
                                            <ul>
                                                @foreach ($customers as $customer)
                                                    <li data-id="{{ $customer->id }}" class="p-2 border-t border-gray-300 cursor-pointer first:border-0 hover:bg-gray-200">{{ $customer->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                    
                                    <div class="mb-3">
                                        <label for="inputAddress" class="block text-sm font-semibold text-gray-600">Address <span class="text-red-500">*</span></label>
                                        <input type="text" id="inputAddress" name="adress" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required autocomplete="off">
                                    </div>
                    
                                    <div class="mb-3">
                                        <label for="inputArea" class="block text-sm font-semibold text-gray-600">Area <span class="text-red-500">*</span></label>
                                        <select id="inputArea" name="area" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option value="CENTRAL">Central</option>
                                            <option value="LUZON">Luzon</option>
                                            <option value="VISAYAS">Visayas</option>
                                            <option value="MINDANAO">Mindanao</option>
                                        </select>
                                    </div>
                                    {{-- CONTACT PERSON --}}
                                        <div class="mb-3">
                                            <h1 class="font-semibold text-gray-600">CONTACT PERSON/s</h1>
                                            <div class="pl-5">
                                                <div class="mb-3">
                                                    <h1 class="text-gray-600">#1</h1>
                                                    <div class="flex flex-col w-full pl-5 gap-x-8">
                                                        <div class="w-full mb-3">
                                                            <label for="inputCP1_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                            <input type="text" id="inputCP1_name" name="cp1_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="inputCP1_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                            <input type="text" id="inputCP1_number" name="cp1_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="inputCP1_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                            <input type="text" id="inputCP1_email" name="cp1_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <h1 class="text-gray-600">#2</h1>
                                                    <div class="flex flex-col w-full pl-5 gap-x-8">
                                                        <div class="w-full mb-3">
                                                            <label for="inputCP2_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                            <input type="text" id="inputCP2_name" name="cp2_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="inputCP2_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                            <input type="text" id="inputCP2_number" name="cp2_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="inputCP2_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                            <input type="text" id="inputCP2_email" name="cp2_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h1 class="text-gray-600">#3</h1>
                                                    <div class="flex flex-col w-full pl-5 gap-x-8">
                                                        <div class="w-full mb-3">
                                                            <label for="inputCP3_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                            <input type="text" id="inputCP3_name" name="cp3_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="inputCP3_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                            <input type="text" id="inputCP3_number" name="cp3_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="inputCP3_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                            <input type="text" id="inputCP3_email" name="cp3_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- CONTACT PERSON END --}}
                                </div>
                            </div>
                            <div class="pl-10">
                                <div class="">
                                    <div class="relative flex flex-col mb-3 optionDiv">
                                        <label for="appname" class="block text-sm font-semibold text-gray-600">Company Name</label>
                                        <input type="text" id="appname" class="block w-full p-2.5 text-gray-600 border border-gray-300 rounded-lg bg-gray-50 sm:text-sm" required autocomplete="off" readonly>
                                    </div>
                    
                                    <div class="mb-3">
                                        <label for="appaddress" class="block text-sm font-semibold text-gray-600">Address <span class="text-red-500">*</span></label>
                                        <input type="text" id="appaddress" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required autocomplete="off" readonly>
                                    </div>
                    
                                    <div class="mb-3">
                                        <label for="apparea" class="block text-sm font-semibold text-gray-600 opacity-50">Area <span class="text-red-500">*</span></label>
                                        <select id="apparea" class=" disabled:opacity-50 bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" disabled>
                                            <option value="CENTRAL"></option>
                                        </select>
                                    </div>
                                    {{-- CONTACT PERSON --}}
                                        <div class="mb-3">
                                            <h1 class="font-semibold text-gray-600">CONTACT PERSON/s</h1>
                                            <div class="pl-5">
                                                <div class="mb-3">
                                                    <h1 class="text-gray-600">#1</h1>
                                                    <div class="flex flex-col w-full pl-5 gap-x-8">
                                                        <div class="w-full mb-3">
                                                            <label for="appcp1_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                            <input type="text" id="appcp1_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off" readonly>
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="appcp1_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                            <input type="text" id="appcp1_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off" readonly>
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="appcp1_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                            <input type="text" id="appcp1_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <h1 class="text-gray-600">#2</h1>
                                                    <div class="flex flex-col w-full pl-5 gap-x-8">
                                                        <div class="w-full mb-3">
                                                            <label for="appcp2_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                            <input type="text" id="appcp2_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off" readonly>
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="appcp2_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                            <input type="text" id="appcp2_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off" readonly>
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="appcp2_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                            <input type="text" id="appcp2_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h1 class="text-gray-600">#3</h1>
                                                    <div class="flex flex-col w-full pl-5 gap-x-8">
                                                        <div class="w-full mb-3">
                                                            <label for="appcp3_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                            <input type="text" id="appcp3_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off" readonly>
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="appcp3_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                            <input type="text" id="appcp3_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off" readonly>
                                                        </div>
                                                        <div class="w-full mb-3">
                                                            <label for="appcp3_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                            <input type="text" id="appcp3_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- CONTACT PERSON END --}}
                                </div>
                            </div>
                        </div>
                        <p class="pt-4 italic">Kindly double-check the information provided above prior to submitting the form.</p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <input type="submit" value="Submit" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60 cursor-pointer">
                        <button data-modal-hide="confirmApproveModal" type="button" class="closeConfirmApproveButton text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- APPROVE MODAL END --}}

    {{-- DELETE MODAL --}}
        <!-- Main modal -->
        <div id="confirmDeleteModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-3xl overflow-x-hidden overflow-y-auto bg-white border border-gray-300 rounded-lg shadow-xl">
                <!-- Modal content -->
                <div class="relative text-gray-700 shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="flex items-center text-xl font-semibold tracking-wide text-gray-900">DECLINE</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="confirmDeleteModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6"> 
                        Are you sure you want to decline this request?
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <a id="confirmDeleteButton" type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60 cursor-pointer">DECLINE</a>
                        <button id="" data-modal-hide="confirmDeleteModal" type="button" class="closeConfirmApproveButton text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- DELETE MODAL END --}}

    {{-- VIEW EVENT MODAL --}}
        <!-- Modal toggle -->
        <button data-modal-target="viewRequestModal" data-modal-toggle="viewRequestModal" id="viewRequestButton" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button"></button>
        
        <!-- Main modal -->
        <div id="viewRequestModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative max-w-[1024px] w-full h-full bg-white rounded-lg overflow-x-hidden overflow-y-auto">
                <!-- Modal content -->
                <div class="relative text-gray-700 shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 id="name" class="flex items-center text-xl font-semibold tracking-wide text-gray-900"></h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="viewRequestModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 overflow-y-hidden overflow-x-hidden h-[calc(100vh-220px)]">
                        <div class="border-r p-4 overflow-y-auto overflow-x-hidden h-[calc(100vh-268px)]">
                            {{-- <div class="grid grid-cols-6">
                                <div class="col-span-2">Request Number: </div>
                                <div id="req_number" class="col-span-4 text-lg font-semibold"></div>

                                <div class="col-span-2">Date: </div>
                                <div id="event_date" class="col-span-4 text-lg font-semibold"></div>

                                <div class="col-span-2">Venue: </div>
                                <div id="venue" class="col-span-4 text-lg font-semibold"></div>

                                <div class="col-span-2">Trainer: </div>
                                <div id="trainer" class="col-span-4 text-lg font-semibold"></div>
                            </div> --}}

                            <div class="">
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
                                    {{-- <div class="col-span-2">Area: </div>
                                    <div id="area" class="col-span-4 text-lg font-semibold"></div> --}}
                                    <div class="col-span-2">Category: </div>
                                    <div id="category" class="col-span-4 text-lg font-semibold"></div>
                                    {{-- <div id="con_details_div" class="grid grid-cols-6 col-span-6">
                                        <div class="col-span-2">Contract Details: </div>
                                        <a href="#" id="contract_details" target="_blank" class="w-40 col-span-4 text-lg font-semibold tracking-wide text-center text-white bg-blue-500 rounded-lg hover:scale-105">VIEW</a>
                                    </div> --}}
                                    <div class="col-span-2">Brand: </div>
                                    <div id="brand" class="col-span-4 text-lg font-semibold"></div>
                                    <div class="col-span-2">Model: </div>
                                    <div id="model" class="col-span-4 text-lg font-semibold"></div>
                                    <div class="col-span-2">Type of Unit: </div>
                                    <div id="unit_type" class="col-span-4 text-lg font-semibold"></div>
                                    <div class="col-span-2">Number of Unit: </div>
                                    <div id="no_of_unit" class="col-span-4 text-lg font-semibold"></div>
                                    <div class="col-span-2">Number of Attendees: </div>
                                    <div id="no_of_attendees" class="col-span-4 text-lg font-semibold"></div>
                                    <div class="col-span-2">Knowledge of Participants: </div>
                                    <div id="knowledge_of_participants" class="col-span-4 text-lg font-semibold"></div>
                                    {{-- <div class="col-span-2">Notes: </div>
                                    <div class="col-span-4 font-semibold">
                                        <textarea id="remarks" class="w-full p-0 text-lg border-0 cursor-default resize-none ring-0 focus:ring-0" readonly></textarea>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="h-full col-span-2 px-4 overflow-x-hidden overflow-y-auto">
                            <div class="relative">
                                <div class="sticky top-0 py-2 bg-white">
                                    <div class="flex items-center mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6"><path d="M477-120q-149 0-253-105.5T120-481h60q0 125 86 213t211 88q127 0 215-89t88-216q0-124-89-209.5T477-780q-68 0-127.5 31T246-667h105v60H142v-208h60v106q52-61 123.5-96T477-840q75 0 141 28t115.5 76.5Q783-687 811.5-622T840-482q0 75-28.5 141t-78 115Q684-177 618-148.5T477-120Zm128-197L451-469v-214h60v189l137 134-43 43Z"/></svg>
                                        <h3 class="ml-1">History Logs</h3>
                                    </div>
                                    <hr>
                                </div>
                                <div id="logsDiv">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="approveButton" data-modal-target="confirmApproveModal" data-modal-toggle="confirmApproveModal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">APPROVE</button>
                        <button id="declineButton" data-modal-target="confirmDeleteModal" data-modal-toggle="confirmDeleteModal" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">DECLINE</button>
                        <button data-modal-hide="viewRequestModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- VIEW EVENT MODAL END --}}

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="h-full p-3 bg-white rounded-lg shadow-xl">
            <div class="p-4 overflow-hidden rounded-lg">
                {{-- CONTROLS --}}
                    <div class="mb-3">
                        <div class="flex flex-row-reverse items-center justify-between">
                            <div class="mb-3 w-52 md:mb-0">
                                <a href="{{ route('customer.request.declined') }}" class="flex items-center justify-center py-2 mt-px text-sm font-semibold text-white bg-blue-600 rounded-lg hover:scale-105 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                                    <span>DECLINED REQUESTS</span></a>
                            </div>
                            <div class="justify-self-end w-[500px] flex items-center">
                                <form method="POST" action="{{ route('customer.request.search') }}" id="searchForm" class="w-full pr-1">
                                    @csrf
                                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <input type="search" id="search" name="search" class="block z-10 w-full px-4 py-2.5 pl-10 text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="SEARCH" value="{{ $search }}" autocomplete="off">
                                        <button id="clearButton" type="button" class="absolute right-20 bottom-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 -960 960 960"><path d="M249-193.434 193.434-249l231-231-231-231L249-766.566l231 231 231-231L766.566-711l-231 231 231 231L711-193.434l-231-231-231 231Z"/></svg>
                                        </button>
                                        <button id="searchSubmit" onclick="$('#loading').toggleClass('hidden');" type="submit" style="bottom: 5px; right: 5px;" type="submit" class="text-white absolute bg-blue-600 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5">Search</button>
                                    </div>
                                </form>
                                <span class="mx-3 text-2xl cursor-default">|</span>
                                <a id="sync" href="{{ route('customer.request.sync') }}" class="flex items-center text-sm text-blue-600 hover:scale-105 gap-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="w-8 h-8"><path xmlns="http://www.w3.org/2000/svg" d="M238-211q-57-53-87.5-122.5T120-480q0-150 105-255t255-105v-80l183 140-183 140v-80q-100 0-170 70t-70 170q0 57 25 107.5t67 88.5l-94 73ZM480-40 297-180l183-140v80q100 0 170-70t70-170q0-57-25-108t-70-88l95-71q58 51 89 120.5T840-480q0 150-105 255T480-120v80Z"/></svg>
                                    Sync
                                </a>
                            </div>
                        </div>
                    </div>
                {{-- CONTROLS END --}}

                <div>
                    {{-- TABLE --}}
                        <div class="hidden md:block">
                            <div id="inventoryTable" class="w-full overflow-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-600 uppercase bg-gray-100">
                                        <tr>
                                            {{-- <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Action
                                            </th> --}}
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Company Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Category
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Brand
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Model
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Type of Unit
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Date Submitted
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requests as $request)
                                            <tr class="bg-white border-b cursor-pointer requestRow hover:bg-gray-200 even:bg-gray-100">
                                                {{-- <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <button type="button" data-modal-target="confirmDeleteModal" data-modal-toggle="confirmDeleteModal" data-id="{{ $request->id }}" class="text-sm font-semibold text-red-600 cursor-pointer deleteButton hover:underline">Decline</button>
                                                </td> --}}
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    <span data-id="{{ $request->id }}">
                                                        {{ strtoupper($request->name) }}
                                                    </span>
                                                </th>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ strtoupper($request->category) }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ strtoupper($request->brand) }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ strtoupper($request->model) }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ strtoupper($request->unit_type) }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $request->created_at }}
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
                                    <h2 id="accordion-collapse-heading-{{$x}}">
                                        <button type="button" class="flex items-center justify-between w-full px-3 py-1.5 text-sm font-semibold text-left text-gray-500 border  border-gray-200 {{ $x == 1 ? 'rounded-t-xl border-b-0' : 'border-b' }} hover:bg-gray-100 focus:bg-gray-900" data-accordion-target="#accordion-collapse-body-{{$x}}" aria-expanded="false" aria-controls="accordion-collapse-body-{{$x}}">
                                            <span>{{ $request->name }}</span>
                                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </h2>
                                    <div id="accordion-collapse-body-{{$x}}" class="hidden" aria-labelledby="accordion-collapse-heading-{{$x}}">
                                        <div class="px-3 py-1.5 font-light border border-b border-gray-200">
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Category</div>
                                                <div class="text-sm font-semibold ">
                                                    {{ $request->category }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Brand</div>
                                                <div class="text-sm font-semibold ">
                                                    {{ $request->brand }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Model</div>
                                                <div class="text-sm font-semibold ">
                                                    {{ $request->model }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Type of Unit</div>
                                                <div class="text-sm font-semibold ">
                                                    {{ $request->unit_type }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Date Submitted</div>
                                                <div class="text-sm cfont-semibold">
                                                    {{ $request->created_at }}
                                                </div>
                                            </div>
                                            {{-- <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Action</div>
                                                <div class="">
                                                    <button type="button" data-modal-target="confirmDeleteModal" data-modal-toggle="confirmDeleteModal" data-key="{{ $request->id }}" class="text-sm font-semibold text-red-600 deleteButton hover:underline">Decline</button>
                                                </div>
                                            </div> --}}
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
            var id = '';

            $(document).click(function(){
                $('#alert-3').addClass('opacity-0');
                setTimeout(function() {
                    $('#notifCloseButton').click();
                }, 550);
            });

            $('.requestRow').click(function(){
                    $('#loading').toggleClass('hidden');
                id = $(this).find('span').data('id');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('customer.request.view') }}",
                    method:"POST",
                    dataType: 'json',
                    data:{
                        id: id,
                        _token: _token
                    },
                    success:function(result){
                        var name = result.name;
                        var address = result.address;
                        
                        var cp1_name = result.cp1_name;
                        var cp1_number = result.cp1_number;
                        var cp1_email = result.cp1_email;
                        
                        var cp2_name = result.cp2_name;
                        var cp2_number = result.cp2_name;
                        var cp2_email = result.cp2_email;
                        
                        var cp3_name = result.cp3_name;
                        var cp3_number = result.cp3_number;
                        var cp3_email = result.cp3_email;

                        var category = result.category;
                        var brand = result.brand;
                        var model = result.model;
                        var unit_type = result.unit_type;
                        var no_of_unit = result.no_of_unit;
                        var no_of_attendees = result.no_of_attendees;
                        var knowledge_of_participants = result.knowledge_of_participants;


                        $('#name').html(name.toUpperCase());
                        $('#appname').val(name.toUpperCase());
                        $('#address').html(address.toUpperCase());
                        $('#appaddress').val(address.toUpperCase());

                        $('#appcp1_name').val(cp1_name.toUpperCase());
                        $('#appcp1_number').val(cp1_number);
                        $('#appcp1_email').val(cp1_email);

                        $('#appcp2_name').val(cp2_name.toUpperCase());
                        $('#appcp2_number').val(cp2_number);
                        $('#appcp2_email').val(cp2_email);

                        $('#appcp3_name').val(cp3_name.toUpperCase());
                        $('#appcp3_number').val(cp3_number);
                        $('#appcp3_email').val(cp3_email);


                        if(cp1_name != '' || cp1_number != '' || cp1_email != ''){
                            $('#cp1_name').html(cp1_name.toUpperCase());
                            $('#cp1_number').html(cp1_number);
                            $('#cp1_email').html(cp1_email);
                            $('#cp1_div').removeClass('hidden');
                        }else{
                            $('#cp1_div').addClass('hidden');
                        }

                        if(cp2_name != '' || cp2_number != '' || cp2_email != ''){
                            $('#cp2_name').html(cp2_name.toUpperCase());
                            $('#cp2_number').html(cp2_number);
                            $('#cp2_email').html(cp2_email);
                            $('#cp2_div').removeClass('hidden');
                        }else{
                            $('#cp2_div').addClass('hidden');
                        }

                        if(cp3_name != '' || cp3_number != '' || cp3_email != ''){
                            $('#cp3_name').html(cp3_name.toUpperCase());
                            $('#cp3_number').html(cp3_number);
                            $('#cp3_email').html(cp3_email);
                            $('#cp3_div').removeClass('hidden');
                        }else{
                            $('#cp3_div').addClass('hidden');
                        }

                        $('#category').html(category.toUpperCase());
                        $('#brand').html(brand.toUpperCase());
                        $('#model').html(model.toUpperCase());
                        $('#unit_type').html(unit_type.toUpperCase());
                        $('#no_of_unit').html(no_of_unit);
                        $('#no_of_attendees').html(no_of_attendees);
                        $('#knowledge_of_participants').html(knowledge_of_participants.toUpperCase());

                        $('#inputID').val(id);
                        $('#inputCategory').val(category.toUpperCase());
                        $('#inputBrand').val(brand.toUpperCase());
                        $('#inputModel').val(model.toUpperCase());
                        $('#inputUnitType').val(unit_type.toUpperCase());
                        $('#inputNoUnit').val(no_of_unit);
                        $('#inputNoAttendees').val(no_of_attendees);
                        $('#inputKnowledge').val(knowledge_of_participants.toUpperCase());

                        $('#loading').toggleClass('hidden');
                        $('#viewRequestButton').click();
                    }
                })
            });

            jQuery(document).on( "click", ".inputOption", function(e){
                $('.content').not($(this).closest('.optionDiv').find('.listOption')).addClass('hidden');
                $(this).closest('.optionDiv').find('.listOption').toggleClass('hidden');
                var value = $(this).val().toLowerCase();
                searchFilter(value);
                e.stopPropagation();
            });

            function searchFilter(searchInput){
                $(".listOption li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchInput) > -1)
                });
            }

            function decodeHTMLEntities(encodedString) {
                const elem = document.createElement("textarea");
                elem.innerHTML = encodedString;
                return elem.value;
            }
            
            jQuery(document).on( "keydown", ".inputOption", function(e){
                var value = $(this).val().toLowerCase();
                searchFilter(value);

                if (event.keyCode === 9) {
                    $('.listOption').addClass('hidden');
                }
            });

            jQuery(document).on( "click", ".listOption li", function(){
                var name = decodeHTMLEntities($(this).html());
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('request.getcom') }}",
                    method:"POST",
                    dataType: 'json',
                    data:{
                        id: id,
                        _token: _token
                    },
                    success:function(result){
                        $('#inputAddress').val(result.address);
                        $('#inputArea').val(result.area);

                        $('#inputCP1_name').val(result.cp1_name);
                        $('#inputCP1_number').val(result.cp1_number);
                        $('#inputCP1_email').val(result.cp1_email);

                        $('#inputCP2_name').val(result.cp2_name);
                        $('#inputCP2_number').val(result.cp2_number);
                        $('#inputCP2_email').val(result.cp2_email);

                        $('#inputCP3_name').val(result.cp3_name);
                        $('#inputCP3_number').val(result.cp3_number);
                        $('#inputCP3_email').val(result.cp3_email);

                        $(".listOption li").closest('.optionDiv').find('input').val(name);
                        $('.listOption').addClass('hidden');
                    }
                })
            });







            
            $('#approveButton').click(function(){
                $('#viewRequestModal').removeClass('z-50');
                $('#viewRequestModal').addClass('z-30');

            });

            $('#declineButton').click(function(){
                $('#viewRequestModal').removeClass('z-50');
                $('#viewRequestModal').addClass('z-30');

            });

            $('.closeConfirmApproveButton').click(function(){
                $('#viewRequestModal').addClass('z-50');
                $('#viewRequestModal').removeClass('z-30');
            });

            $('.closeConfirmApproveButton').click(function(){
                $('#viewRequestModal').addClass('z-50');
                $('#viewRequestModal').removeClass('z-30');
            });

            $('#confirmDeleteButton').click(function(){
                window.location.href = `/request-from-customers/decline/${id}`;
            });

            $('#clearButton').click(function(){
                $('#search').val('');
                $('#searchSubmit').click();
            });
        });
    </script>
@endsection
