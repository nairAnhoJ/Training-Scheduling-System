@extends('layouts.app')
@section('title','REQUESTS')
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
        <!-- Modal toggle -->
        <button data-modal-target="confirmApproveModal" data-modal-toggle="confirmApproveModal" id="confirmApproveButton" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button"></button>
        
        <!-- Main modal -->
        <div id="confirmApproveModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-[60] hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-3xl bg-white border border-gray-300 shadow-xl rounded-lg overflow-x-hidden overflow-y-auto">
                <!-- Modal content -->
                <div class="relative shadow text-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl tracking-wide font-semibold text-gray-900 flex items-center">APPROVE</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="confirmApproveModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        Are you sure you want to approve this request?
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <a id="confirmApproveButtona" data-modal-hide="confirmApproveModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">APPROVE</a>
                        <button id="closeConfirmApproveButton" data-modal-hide="confirmApproveModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- APPROVE MODAL END --}}


    {{-- VIEW EVENT MODAL --}}
        <!-- Modal toggle -->
        <button data-modal-target="viewRequestModal" data-modal-toggle="viewRequestModal" id="viewRequestButton" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button"></button>
        
        <!-- Main modal -->
        <div id="viewRequestModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-5xl h-full bg-white rounded-lg overflow-x-hidden overflow-y-auto">
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
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="approveButton" data-modal-target="confirmApproveModal" data-modal-toggle="confirmApproveModal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center tracking-wide disabled:pointer-events-none disabled:opacity-60">APPROVE</button>
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
                        <div class="md:grid md:grid-cols-2">
                            <div class="w-24 mb-3 md:mb-0">
                                <a href="{{ route('request.add') }}" class="flex justify-center items-center text-white bg-blue-600 hover:scale-105 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm py-2 focus:outline-none mt-px">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition duration-75 mr-1" fill="currentColor" viewBox="0 -960 960 960"><path d="M440.391-190.391v-250h-250v-79.218h250v-250h79.218v250h250v79.218h-250v250h-79.218Z"/></svg>
                                    <span>ADD</span></a>
                            </div>
                            <div class="justify-self-end w-full xl:w-4/5">
                                <form method="GET" action="" id="searchForm" class="w-full">
                                    <label for="searchInput" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <input type="search" id="searchInput" class="block z-10 w-full px-4 py-2.5 pl-10 text-sm text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="SEARCH" value="{{ $search }}" autocomplete="off">
                                        <button id="clearButton" type="button" class="absolute right-20 bottom-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition duration-75 group-hover:text-gray-900 mr-1 text-gray-500" fill="currentColor" viewBox="0 -960 960 960"><path d="M249-193.434 193.434-249l231-231-231-231L249-766.566l231 231 231-231L766.566-711l-231 231 231 231L711-193.434l-231-231-231 231Z"/></svg>
                                        </button>
                                        <button id="searchButton" type="button" style="bottom: 5px; right: 5px;" type="submit" class="text-white absolute bg-blue-600 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5">Search</button>
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
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Company Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Category
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Type of Unit
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Billing Type
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Area
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Trainer
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Last Updated
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requests as $request)
                                            <tr class="requestRow bg-white border-b cursor-pointer hover:bg-gray-200 even:bg-gray-100">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    <span data-key="{{ $request->key }}">
                                                        {{ $request->name }}
                                                    </span>
                                                </th>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $request->category }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $request->unit_type }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $request->billing_type }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $request->area }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $request->first_name.' '.$request->last_name }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ date('F j, Y', strtotime($request->updated_at)) }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <a href="{{ url('/request/edit/'.$request->key) }}" class="editButton text-blue-600 hover:underline font-semibold text-sm">Edit</a> | <a type="button" class="deleteButton text-red-600 hover:underline font-semibold text-sm cursor-pointer">Delete</a>
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
                                                <div class="text-xs leading-5">Type of Unit</div>
                                                <div class=" font-semibold text-sm">
                                                    {{ $request->unit_type }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Billing Type</div>
                                                <div class="font-semibold text-sm">
                                                    {{ $request->billing_type }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Area</div>
                                                <div class="cfont-semibold text-sm">
                                                    {{ $request->area }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Action</div>
                                                <div class="">
                                                    <a href="#" class="text-blue-600 hover:underline font-semibold text-sm">Edit</a> | 
                                                    <a type="button" class="deleteButton text-red-600 hover:underline font-semibold text-sm">Delete</a>
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

            $(document).click(function(){
                $('#alert-3').addClass('opacity-0');
                setTimeout(function() {
                    $('#notifCloseButton').click();
                }, 550);
            });

            $('.requestRow').click(function(){
                var key = $(this).find('span').data('key');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('request.view') }}",
                    method:"POST",
                    dataType: 'json',
                    data:{
                        key: key,
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

            $('#approveButton').click(function(){
                $('#viewRequestModal').removeClass('z-50');
                $('#viewRequestModal').addClass('z-30');

            });

            $('#closeConfirmApproveButton').click(function(){
                $('#viewRequestModal').addClass('z-50');
                $('#viewRequestModal').removeClass('z-30');
            });
        });
    </script>
@endsection
