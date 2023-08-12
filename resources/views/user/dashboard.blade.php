@extends('layouts.app')
@section('title','DASHBOARD')
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
        <div class="bg-white shadow-xl rounded-lg py-5 pl-5 pr-8 h-full overflow-y-auto">
            <div class="">
                <div class="flex flex-col">

                    <div class="shadow-[0_0px_5px_1px_rgb(0,0,0,0.15)] rounded-lg overflow-hidden mb-5">
                        <div class="flex items-center">
                            <div class="h-24">
                                <div class="bg-emerald-500 h-full w-24 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white transition duration-75 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path xmlns="http://www.w3.org/2000/svg" d="M433-228 295-365l42-42 96 94 184-184 42 43-226 226ZM180-80q-24 0-42-18t-18-42v-620q0-24 18-42t42-18h65v-60h65v60h340v-60h65v60h65q24 0 42 18t18 42v620q0 24-18 42t-42 18H180Zm0-60h600v-430H180v430Zm0-490h600v-130H180v130Zm0 0v-130 130Z"/></svg>
                                </div>
                            </div>
                            <div>
                                <div class="flex flex-col px-5">
                                    <h1 class="text-3xl font-semibold">99</h1>
                                    <h1 class="text-sm">Upcoming Trainings</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="shadow-[0_0px_5px_1px_rgb(0,0,0,0.15)] rounded-lg overflow-hidden mb-5">
                        <div class="flex items-center">
                            <div class="h-24">
                                <div class="bg-amber-500 h-full w-24 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white transition duration-75 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path xmlns="http://www.w3.org/2000/svg" d="M433-228 295-365l42-42 96 94 184-184 42 43-226 226ZM180-80q-24 0-42-18t-18-42v-620q0-24 18-42t42-18h65v-60h65v60h340v-60h65v60h65q24 0 42 18t18 42v620q0 24-18 42t-42 18H180Zm0-60h600v-430H180v430Zm0-490h600v-130H180v130Zm0 0v-130 130Z"/></svg>
                                </div>
                            </div>
                            <div>
                                <div class="flex flex-col px-5">
                                    <h1 class="text-3xl font-semibold">99</h1>
                                    <h1 class="text-sm">Pending Request</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="shadow-[0_0px_5px_1px_rgb(0,0,0,0.15)] rounded-lg overflow-hidden">
                        <div class="flex items-center">
                            <div class="h-24">
                                <div class="bg-red-500 h-full w-24 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white transition duration-75 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path xmlns="http://www.w3.org/2000/svg" d="M433-228 295-365l42-42 96 94 184-184 42 43-226 226ZM180-80q-24 0-42-18t-18-42v-620q0-24 18-42t42-18h65v-60h65v60h340v-60h65v60h65q24 0 42 18t18 42v620q0 24-18 42t-42 18H180Zm0-60h600v-430H180v430Zm0-490h600v-130H180v130Zm0 0v-130 130Z"/></svg>
                                </div>
                            </div>
                            <div>
                                <div class="flex flex-col px-5">
                                    <h1 class="text-3xl font-semibold">99</h1>
                                    <h1 class="text-sm">Pending Request From Customer</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
        });
    </script>
@endsection
