@extends('layouts.app')
@section('title','USERS')
@section('content')

    @if(session('success'))
        <div id="alert-3" class="absolute left-1/2 -translate-x-1/2 top-16 z-[99] shadow-lg border border-emerald-500 w-[calc(100%-10px)] sm:w-[500px] flex p-4 mb-4 text-green-50 rounded-lg bg-emerald-500" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 hover:scale-105 inline-flex h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif


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
                                <div id="viewDate" class="col-span-4 font-semibold text-lg">BRGY. SAKSAKAN, MAKAILAG, SWERTE</div>
                            </div>

                            <div class="mt-5">
                                <div class="flex items-center">
                                    <h1 class="text-xl mr-3 whitespace-nowrap text-gray-700 font-bold tracking-wider">CUSTOMER DETAILS</h1><hr class="w-full whitespace-nowrap border-gray-500">
                                </div>
                                <div class="grid grid-cols-5">
                                    <div>Address: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">BRGY. SAKSAKAN, MAKAILAG, SWERTE</div>

                                    <h3 class="font-semibold col-span-5">Contact Person/s:</h3>
                                    <div class="ml-10">Name: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">JUAN DELA CRUZ</div>
                                    <div class="ml-10">Date: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">09123456789</div>
                                    <div class="ml-10">E-mail: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">juan.delacruz@email.com <br>*note: Kung tatlo po ang contact person tatlo rin po ang lalabas dito.</div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <div class="flex items-center">
                                    <h1 class="text-xl mr-3 whitespace-nowrap text-gray-700 font-bold tracking-wider">OTHER DETAILS</h1><hr class="w-full whitespace-nowrap border-gray-500">
                                </div>
                                <div class="grid grid-cols-5">
                                    <div>Area: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">NORTH</div>
                                    <div>Billing Type: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">CHARGEABLE</div>
                                    <div>Type: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">RENTAL UNIT</div>
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

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="bg-white shadow-xl rounded-lg p-3 h-full">
            <div class="overflow-hidden rounded-lg p-4">
                {{-- CONTROLS --}}
                    <div class="mb-3">
                        <div class="md:grid md:grid-cols-2">
                            <div class="w-24 mb-3 md:mb-0">
                                <a href="{{ route('users.add') }}" class="flex justify-center items-center text-white bg-blue-600 hover:scale-105 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm py-2 focus:outline-none mt-px">
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
                                                Full Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                ID Number
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Department
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                E-mail
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Role
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            @php
                                                if($user->role == 0){
                                                    $role = 'ADMINISTRATOR';
                                                }else if($user->role == 1){
                                                    $role = 'TRAINING COORDINATOR';
                                                }else if($user->role == 2){
                                                    $role = 'TRAINER';
                                                }else if($user->role == 3){
                                                    $role = 'VIEWING ONLY';
                                                }
                                            @endphp
                                            <tr class="bg-white border-b cursor-pointer hover:bg-gray-200 even:bg-gray-100">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $user->first_name.' '.$user->last_name }}
                                                </th>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $user->id_number }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $user->dept }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $user->email }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $role }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <a href="{{ url('/system-management/users/edit/'.$user->key) }}" class="text-blue-600 hover:underline font-semibold text-sm">Edit</a> | <a type="button" data-key="{{ $user->key }}" class="deleteButton text-red-600 hover:underline font-semibold text-sm cursor-pointer">Delete</a>
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
                                @foreach ($users as $user)
                                    @php
                                        if($user->role == 0){
                                            $role = 'ADMINISTRATOR';
                                        }else if($user->role == 1){
                                            $role = 'TRAINING COORDINATOR';
                                        }else if($user->role == 2){
                                            $role = 'TRAINER';
                                        }else if($user->role == 3){
                                            $role = 'VIEWING ONLY';
                                        }
                                    @endphp
                                    <h2 id="accordion-collapse-heading-{{$x}}">
                                        <button type="button" class="flex items-center justify-between w-full px-3 py-1.5 text-sm font-semibold text-left text-gray-500 border  border-gray-200 {{ $x == 1 ? 'rounded-t-xl border-b-0' : 'border-b' }} hover:bg-gray-100 focus:bg-gray-900" data-accordion-target="#accordion-collapse-body-{{$x}}" aria-expanded="false" aria-controls="accordion-collapse-body-{{$x}}">
                                            <span>{{ $user->first_name.' '.$user->last_name }}</span>
                                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </h2>
                                    <div id="accordion-collapse-body-{{$x}}" class="hidden" aria-labelledby="accordion-collapse-heading-{{$x}}">
                                        <div class="px-3 py-1.5 font-light border border-b border-gray-200">
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">ID Number</div>
                                                <div class=" font-semibold text-sm">
                                                    {{ $user->id_number }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Department</div>
                                                <div class=" font-semibold text-sm">
                                                    {{ $user->dept }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">E-mail</div>
                                                <div class="font-semibold text-sm">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Role</div>
                                                <div class="cfont-semibold text-sm">
                                                    {{ $role }}
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




                                {{-- @php
                                    $x = 1;
                                    foreach ($users as $user) {
                                        if($x == 1){
                                            echo '
                                                <h2 id="accordion-collapse-heading-'.$x.'">
                                                    <button type="button" class="flex items-center justify-between w-full px-3 py-1.5 text-sm font-semibold text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl hover:bg-gray-100" data-accordion-target="#accordion-collapse-body-'.$x.'" aria-expanded="false" aria-controls="accordion-collapse-body-'.$x.'">
                                                        <span>'.$user->name.'</span>
                                                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </h2>
                                                <div id="accordion-collapse-body-'.$x.'" class="hidden" aria-labelledby="accordion-collapse-heading-'.$x.'">
                                                    <div class="px-3 py-1.5 font-light border border-b-0 border-gray-200">
                                                        <div class="grid grid-cols-3">
                                                            <div class="text-xs leading-5">Username</div>
                                                            <div class="col-span-2 font-semibold text-sm">
                                                                '.$user->username.'
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-3">
                                                            <div class="text-xs leading-5">Username</div>
                                                            <div class="col-span-2 font-semibold text-sm">
                                                                '.$role.'
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-3">
                                                            <div class="text-xs leading-5">Action</div>
                                                            <div class="col-span-2">
                                                                <a href="'.url('/system-management/user/edit/'.$user->slug).'" class="text-blue-600 hover:underline font-semibold text-sm">Edit</a> | 
                                                                <a type="button" data-modal-target="itemDeleteModal" data-modal-toggle="itemDeleteModal" data-slug="'.$user->slug.'" class="deleteButton text-red-600 hover:underline font-semibold text-sm">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }else if($x == $users->count()){
                                            echo '
                                                <h2 id="accordion-collapse-heading-'.$x.'">
                                                    <button type="button" class="flex items-center justify-between w-full px-3 py-1.5 text-sm font-medium text-left text-gray-500 border border-gray-200 hover:bg-gray-100" data-accordion-target="#accordion-collapse-body-'.$x.'" aria-expanded="false" aria-controls="accordion-collapse-body-'.$x.'">
                                                        <span>'.$user->name.'</span>
                                                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </h2>
                                                <div id="accordion-collapse-body-'.$x.'" class="hidden" aria-labelledby="accordion-collapse-heading-'.$x.'">
                                                    <div class="px-3 py-1.5 font-light border border-t-0 border-gray-200 rounded-b-xl">
                                                        <div class="grid grid-cols-3 content-center">
                                                            <div class="text-xs leading-5">Category</div>
                                                            <div class="col-span-2 font-semibold text-sm">
                                                                '.$user->username.'
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-3">
                                                            <div class="text-xs leading-5">Username</div>
                                                            <div class="col-span-2 font-semibold text-sm">
                                                                '.$role.'
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-3">
                                                            <div>Action</div>
                                                            <div class="col-span-2">
                                                                <a href="'.url('/system-management/user/edit/'.$user->slug).'" class="text-blue-600 hover:underline font-semibold text-sm">Edit</a> | 
                                                                <a type="button" data-modal-target="itemDeleteModal" data-modal-toggle="itemDeleteModal" data-slug="'.$user->slug.'" class="deleteButton text-red-600 hover:underline font-semibold text-sm">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }else{
                                            echo '
                                                <h2 id="accordion-collapse-heading-'.$x.'">
                                                    <button type="button" class="flex items-center justify-between w-full px-3 py-1.5 text-sm font-medium text-left text-gray-500 border border-b-0 border-gray-200 hover:bg-gray-100" data-accordion-target="#accordion-collapse-body-'.$x.'" aria-expanded="false" aria-controls="accordion-collapse-body-'.$x.'">
                                                        <span>'.$user->name.'</span>
                                                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </h2>
                                                <div id="accordion-collapse-body-'.$x.'" class="hidden" aria-labelledby="accordion-collapse-heading-'.$x.'">
                                                    <div class="px-3 py-1.5 font-light border border-b-0 border-gray-200">
                                                        <div class="grid grid-cols-3 content-center">
                                                            <div class="text-xs leading-5">Category</div>
                                                            <div class="col-span-2 font-semibold text-sm">
                                                                '.$user->username.'
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-3">
                                                            <div class="text-xs leading-5">Username</div>
                                                            <div class="col-span-2 font-semibold text-sm">
                                                                '.$role.'
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-3">
                                                            <div class="text-xs leading-5">Action</div>
                                                            <div class="col-span-2">
                                                                <a href="'.url('/system-management/user/edit/'.$user->slug).'" class="text-blue-600 hover:underline font-semibold text-sm">Edit</a> | 
                                                                <a type="button" data-modal-target="itemDeleteModal" data-modal-toggle="itemDeleteModal" data-slug="'.$user->slug.'" class="deleteButton text-red-600 hover:underline font-semibold text-sm">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                        $x++;
                                    }
                                @endphp --}}
                            </div>
                        </div>
                    {{-- INVENTORY LIST SMALL DEVICE END --}}
                </div>

                {{-- PAGINATION --}}
                    {{-- <div class="grid md:grid-cols-2 mt-3 px-3">
                        @php
                            $prev = $page - 1;
                            $next = $page + 1;
                            $from = ($prev * 100) + 1;
                            $to = $page * 100;
                            if($to > $users->count()){
                                $to = $users->count();
                            }if($users->count() == 0){
                                $from = 0;
                            }
                        @endphp
                        <div class="justify-self-center md:justify-self-start self-center">
                            <span class="text-sm text-gray-700">
                                Showing <span class="font-semibold text-gray-900">{{ $from }}</span> to <span class="font-semibold text-gray-900">{{ $to }}</span> of <span class="font-semibold text-gray-900">{{ $users->count() }}</span> Items
                            </span>
                        </div>

                        <div class="justify-self-center md:justify-self-end">
                            <nav aria-label="Page navigation example" class="h-8 mb-0.5">
                                <ul class="inline-flex items-center -space-x-px">
                                    <li>
                                        <a href="{{ ($search == '') ? url('/system-management/user/'.$prev) : url('/system-management/user/'.$prev.'/'.$search);  }}"  class="{{ ($page == 1) ? 'pointer-events-none' : ''; }} w-10 h-10 leading-9 text-center text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition duration-75 group-hover:text-gray-900 mr-1 text-gray-500" fill="currentColor" viewBox="0 -960 960 960"><path xmlns="http://www.w3.org/2000/svg" d="M561-226.434 306.434-481 561-735.566 617.566-679l-198 198 198 198L561-226.434Z"/></svg>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li>
                                        <p class="block w-24 h-10 leading-9 text-center z-10 text-gray-500 border border-gray-300 bg-white font-semibold">Page {{ $page }}</p>
                                    </li>
                                    <li>
                                        <a href="{{ ($search == '') ? url('/system-management/user/'.$next) : url('/system-management/user/'.$next.'/'.$search); }}" class="{{ ($to == $users->count()) ? 'pointer-events-none' : ''; }} w-10 h-10 leading-9 text-center text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition duration-75 group-hover:text-gray-900 mr-1 text-gray-500" fill="currentColor" viewBox="0 -960 960 960"><path xmlns="http://www.w3.org/2000/svg" d="M375-226.434 318.434-283l198-198-198-198L375-735.566 629.566-481 375-226.434Z"/></svg>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div> --}}
                {{-- PAGINATION END --}}


            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            
        });
    </script>
@endsection
