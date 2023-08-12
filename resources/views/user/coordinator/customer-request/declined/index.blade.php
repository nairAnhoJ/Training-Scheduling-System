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

    {{-- RESTORE MODAL --}}
        <!-- Main modal -->
        <div id="confirmApproveModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-3xl bg-white border border-gray-300 shadow-xl rounded-lg overflow-x-hidden overflow-y-auto">
                <!-- Modal content -->
                <div class="relative shadow text-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl tracking-wide font-semibold text-gray-900 flex items-center">RESTORE</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="confirmApproveModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6"> 
                        Are you sure you want to restore this request?
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <a id="confirmRestoreButton" type="button" class="text-white bg-emerald-500 hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60 cursor-pointer">RESTORE</a>
                        <button id="" data-modal-hide="confirmApproveModal" type="button" class="closeConfirmApproveButton text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- RESTORE MODAL END --}}

    {{-- DELETE MODAL --}}
        <!-- Main modal -->
        <div id="confirmDeleteModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-3xl bg-white border border-gray-300 shadow-xl rounded-lg overflow-x-hidden overflow-y-auto">
                <!-- Modal content -->
                <div class="relative shadow text-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl tracking-wide font-semibold text-gray-900 flex items-center">DELETE</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="confirmDeleteModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6"> 
                        Are you sure you want to permanently delete this request?
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
                    <div class="p-6 overflow-y-hidden overflow-x-hidden h-[calc(100vh-220px)]">
                        <div class="border-r p-4 overflow-y-auto overflow-x-hidden h-[calc(100vh-268px)]">
                            <div class="">
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
                                    <div class="col-span-2">Category: </div>
                                    <div id="category" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Brand: </div>
                                    <div id="brand" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Model: </div>
                                    <div id="model" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Type of Unit: </div>
                                    <div id="unit_type" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Number of Unit: </div>
                                    <div id="no_of_unit" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Number of Attendees: </div>
                                    <div id="no_of_attendees" class="col-span-4 font-semibold text-lg"></div>
                                    <div class="col-span-2">Knowledge of Participants: </div>
                                    <div id="knowledge_of_participants" class="col-span-4 font-semibold text-lg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="approveButton" data-modal-target="confirmApproveModal" data-modal-toggle="confirmApproveModal" class="text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">RESTORE</button>
                        <button id="declineButton" data-modal-target="confirmDeleteModal" data-modal-toggle="confirmDeleteModal" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">DELETE</button>
                        <button data-modal-hide="viewRequestModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- VIEW EVENT MODAL END --}}

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="bg-white shadow-xl rounded-lg p-3 h-full">
            <div class="overflow-hidden rounded-lg p-4">
                {{-- CONTROLS --}}
                    <div class="mb-3">
                        <div class="flex flex-row-reverse items-center justify-between">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition duration-75 group-hover:text-gray-900 mr-1 text-gray-500" fill="currentColor" viewBox="0 -960 960 960"><path d="M249-193.434 193.434-249l231-231-231-231L249-766.566l231 231 231-231L766.566-711l-231 231 231 231L711-193.434l-231-231-231 231Z"/></svg>
                                        </button>
                                        <button id="searchSubmit" onclick="$('#loading').toggleClass('hidden');" type="submit" style="bottom: 5px; right: 5px;" type="submit" class="text-white absolute bg-blue-600 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="w-32 md:mb-0">
                                <a href="{{ route('customer.request.index') }}" class="flex justify-center items-center text-white bg-blue-600 hover:scale-105 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm py-2 focus:outline-none mt-px">
                                BACK</a>
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
                                            <tr class="requestRow bg-white border-b cursor-pointer hover:bg-gray-200 even:bg-gray-100">
                                                {{-- <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <button type="button" data-modal-target="confirmDeleteModal" data-modal-toggle="confirmDeleteModal" data-id="{{ $request->id }}" class="deleteButton text-red-600 hover:underline font-semibold text-sm cursor-pointer">Decline</button>
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
                                                <div class=" font-semibold text-sm">
                                                    {{ $request->category }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Brand</div>
                                                <div class=" font-semibold text-sm">
                                                    {{ $request->brand }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Model</div>
                                                <div class=" font-semibold text-sm">
                                                    {{ $request->model }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Type of Unit</div>
                                                <div class=" font-semibold text-sm">
                                                    {{ $request->unit_type }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Date Submitted</div>
                                                <div class="cfont-semibold text-sm">
                                                    {{ $request->created_at }}
                                                </div>
                                            </div>
                                            {{-- <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Action</div>
                                                <div class="">
                                                    <button type="button" data-modal-target="confirmDeleteModal" data-modal-toggle="confirmDeleteModal" data-key="{{ $request->id }}" class="deleteButton text-red-600 hover:underline font-semibold text-sm">Decline</button>
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

            $('#confirmDeleteButton').click(function(){
                window.location.href = `/request-from-customers/declined/delete/${id}`;
            });

            $('#confirmRestoreButton').click(function(){
                window.location.href = `/request-from-customers/declined/restore/${id}`;
            });

            $('#clearButton').click(function(){
                $('#search').val('');
                $('#searchSubmit').click();
            });
        });
    </script>
@endsection
