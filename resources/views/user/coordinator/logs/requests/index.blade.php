@extends('layouts.app')
@section('title','LOGS - TRAININGS')
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

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="bg-white shadow-xl rounded-lg p-3 h-full">
            <div class="overflow-hidden rounded-lg p-4">
                {{-- CONTROLS --}}
                    @csrf
                    <div class="mb-3">
                        <div class="md:grid md:grid-cols-2">
                            <div></div>
                            {{-- <div class="w-24 mb-3 md:mb-0">
                                <a href="{{ route('request.add') }}" class="flex justify-center items-center text-white bg-blue-600 hover:scale-105 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm py-2 focus:outline-none mt-px">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition duration-75 mr-1" fill="currentColor" viewBox="0 -960 960 960"><path d="M440.391-190.391v-250h-250v-79.218h250v-250h79.218v250h250v79.218h-250v250h-79.218Z"/></svg>
                                    <span>ADD</span></a>
                            </div> --}}
                            <div class="justify-self-end w-full xl:w-4/5">
                                <form method="GET" action="" id="searchForm" class="w-full">
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
                                        <button id="searchSubmit" type="button" style="bottom: 5px; right: 5px;" type="submit" class="text-white absolute bg-blue-600 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5">Search</button>
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
                                    <thead class="text-xs text-gray-50 uppercase bg-gray-600 tracking-wide">
                                        <tr class="border-b border-gray-400">
                                            <th scope="col" class="px-6 py-2 text-center whitespace-nowrap border-r border-gray-400">
                                                Date
                                            </th>
                                            <th scope="col" class="px-6 py-2 text-center whitespace-nowrap border-r border-gray-400">
                                                User
                                            </th>
                                            <th scope="col" class="px-6 py-2 text-center whitespace-nowrap border-r border-gray-400">
                                                Command
                                            </th>
                                            <th scope="col" class="px-6 py-2 text-center whitespace-nowrap border-r border-gray-400">
                                                Description
                                            </th>
                                            <th scope="col" class="px-6 py-2 text-center whitespace-nowrap border-r border-gray-400">
                                                Before Change
                                            </th>
                                            <th scope="col" class="px-6 py-2 text-center whitespace-nowrap">
                                                After Change
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $log)
                                            <tr class="bg-white border-b border-gray-400 hover:bg-gray-300 even:bg-gray-200">
                                                <td class="px-6 py-2 text-center whitespace-nowrap border-r border-gray-400">
                                                    {{ $log->created_at }}
                                                </td>
                                                <td class="px-6 py-2 text-center whitespace-nowrap border-r border-gray-400">
                                                    {{ $log->first_name.' '.$log->last_name }}
                                                </td>
                                                <td class="px-6 py-2 text-center whitespace-nowrap border-r border-gray-400">
                                                    {{ $log->action }}
                                                </td>
                                                <td class="px-6 py-2 whitespace-nowrap border-r border-gray-400">
                                                    {{ $log->description.' >> '.$log->field }}
                                                </td>
                                                <td class="px-6 py-2 whitespace-nowrap border-r border-gray-400">
                                                    {{ $log->before }}
                                                </td>
                                                <td class="px-6 py-2 whitespace-nowrap">
                                                    {{ $log->after }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    {{-- TABLE END --}}

                    {{-- TABLE SMALL DEVICE --}}
                        <div class="overflow-auto md:hidden">
                            <div id="accordion-collapse" data-accordion="collapse">
                                @php
                                    $x = 1;
                                @endphp
                                @foreach ($logs as $log)
                                    <h2 id="accordion-collapse-heading-{{$x}}">
                                        <button type="button" class="flex items-center justify-between w-full px-3 py-1.5 text-sm font-semibold text-left text-gray-500 border  border-gray-200 {{ $x == 1 ? 'rounded-t-xl border-b-0' : 'border-b' }} hover:bg-gray-100 focus:bg-gray-900" data-accordion-target="#accordion-collapse-body-{{$x}}" aria-expanded="false" aria-controls="accordion-collapse-body-{{$x}}">
                                            <span>{{ $log->created_at }}</span>
                                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </h2>
                                    <div id="accordion-collapse-body-{{$x}}" class="hidden" aria-labelledby="accordion-collapse-heading-{{$x}}">
                                        <div class="px-3 py-1.5 font-light border border-b border-gray-200">
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">User</div>
                                                <div class=" font-semibold text-sm">
                                                    {{ $log->first_name.' '.$log->last_name }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Command</div>
                                                <div class=" font-semibold text-sm">
                                                    {{ $log->action }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Description</div>
                                                <div class="font-semibold text-sm">
                                                    {{ $log->description }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Before Change</div>
                                                <div class="cfont-semibold text-sm">
                                                    {{ $log->before }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">After Change</div>
                                                <div class="cfont-semibold text-sm">
                                                    {{ $log->after }}
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
                    {{-- TABLE SMALL DEVICE END --}}

                    {{-- PAGINATION --}}
                        @php
                            $prev = $page - 1;
                            $next = $page + 1;
                            $from = ($prev * 50) + 1;
                            $to = $page * 50;
                            if($to > $logsCount){
                                $to = $logsCount;
                            }if($logsCount == 0){
                                $from = 0;
                            }
                        @endphp
                        <div class="flex flex-row items-center w-full justify-between mt-2">
                            <!-- Help text -->
                            <span class="text-sm text-gray-700">
                                Showing <span class="font-semibold text-gray-700">{{$from}}</span> to <span class="font-semibold text-gray-700">{{$to}}</span> of <span class="font-semibold text-gray-700">{{ $logsCount }}</span> results
                            </span>
                            <!-- Buttons -->
                            <div class="inline-flex xs:mt-0">
                                <a href="{{ url('/logs/customers/'.$prev.'/'.$search) }}" class="{{ ($page == 1) ? 'pointer-events-none' : ''; }} inline-flex items-center px-4 py-2 mr-3 text-sm font-medium text-gray-500 bg-white border border-gray-400 rounded-lg hover:bg-gray-100 hover:text-gray-700 w-32">
                                    <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                                    Previous
                                </a>
                                <a href="{{ url('/logs/customers/'.$next.'/'.$search) }}" class="{{ ($to == $logsCount) ? 'pointer-events-none' : ''; }} flex items-center text-center px-8 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-400 rounded-lg hover:bg-gray-100 hover:text-gray-700 w-32">
                                    Next
                                    <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                        </div>
                    {{-- PAGINATION END --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#searchSubmit').click(function() {
                var searchValue = $('#search').val();
                var pageValue = '<?php echo $page; ?>';
                var actionUrl = "{{ url('/logs/customers/') }}" + "/" + pageValue + "/" + searchValue;

                $('#searchForm').attr('action', actionUrl);
                $('#searchForm').submit();
            });

            $('#clearButton').click(function() {
                var searchValue = '';
                var pageValue = '<?php echo $page; ?>';
                var actionUrl = "{{ url('/logs/customers/') }}" + "/" + pageValue + "/" + searchValue;

                $('#searchForm').attr('action', actionUrl);
                $('#searchForm').submit();
            });
            
            $('#search').keypress(function(event) {
                if (event.which === 13) {
                    event.preventDefault();
                    $('#searchSubmit').click();
                }
            });
        });
    </script>
@endsection
