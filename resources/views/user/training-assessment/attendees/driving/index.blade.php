@extends('layouts.app')
@section('title','WRITTEN EXAM')
@section('content')
    
    {{-- SUBMIT MODAL --}}
        <div id="submitModal" class="hidden absolute top-0 left-0 w-screen h-screen bg-gray-900 z-[109] !bg-opacity-50 overflow-hidden flex items-center justify-center p-5">
            <div class="w-5/6 bg-white rounded-lg">
                <!-- Modal content -->
                <div class="relative h-full bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Submit
                        </h3>
                        <button type="button" class="inline-flex items-center justify-center w-8 h-8 ml-auto text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 closeSubmitModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="!m-0 overflow-scroll sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="flex items-start justify-center px-10 py-4 overflow-x-hidden overflow-y-auto">
                        <div class="w-full text-sm">
                            <p class="text-lg">Are you sure you want to submit the exam?</p>
                            <p class="mt-5 italic text-sm">Note:</p>
                            <p class="italic text-sm">Once you submit your exam, you cannot make any further changes or undo your submission.</p>
                            <p class="mt-1 italic text-sm">Please review your answers carefully before submitting.</p>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button id="ConfirmSubmitButton" type="submit" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-blue-200 text-sm font-bold md:w-24 w-1/2 py-2.5 focus:z-10">YES</button>
                        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-bold md:w-24 w-1/2 py-2.5 hover:text-gray-900 focus:z-10 closeSubmitModal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- SUBMIT MODAL// --}}

    <div class="w-full p-5 bg-gray-200">
        <div class="h-[calc(100vh-96px)] bg-white rounded-xl shadow-xl">
            <div class="h-full rounded-xl">
                <div class="h-full flex flex-col">
                    
                    <input type="hidden" value="{{ $exam->id }}" id="exam">
                    @csrf
                    
                    {{-- CONTENT --}}
                        <div id="content" class="h-[calc(100%-88px)] relative overflow-y-auto {{ ($attendee->written_score != null) ? '' : 'px-5' }}">

                            

                        </div>
                    {{-- CONTENT --}}
                        
                    {{-- CONTROLS --}}
                        <div id="controlDiv" class="w-full mt-5 flex flex-row-reverse gap-x-4 px-5 pb-5">
                            @if ($attendee->written_score != null)
                                {{-- <button id="resultSummaryButton" class="h-12 w-full border rounded-xl bg-blue-500 text-white font-black tracking-wider px-4 flex items-center justify-between">
                                    <div class="w-6"></div>
                                    <div>RESULTS SUMMARY</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="currentColor">
                                        <path d="m304-58-80-81 343-343-343-343 80-81 424 424L304-58Z"/>
                                    </svg>
                                </button> --}}
                            @else
                                <button id="submitButton" class="hidden h-12 w-full border rounded-xl bg-blue-500 text-white font-black tracking-wider px-4 flex items-center justify-between">
                                    <div class="w-6"></div>
                                    <div>SUBMIT</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="currentColor">
                                        <path d="m304-58-80-81 343-343-343-343 80-81 424 424L304-58Z"/>
                                    </svg>
                                </button>
                                <button id="nextButton" class="h-12 w-full border rounded-xl bg-blue-500 text-white font-black tracking-wider px-4 flex items-center justify-between">
                                    <div class="w-6"></div>
                                    <div id="nsLabel">START</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="currentColor">
                                        <path d="m304-58-80-81 343-343-343-343 80-81 424 424L304-58Z"/>
                                    </svg>
                                </button>
                                <button id="backButton" class="hidden h-12 w-full border rounded-xl bg-blue-500 text-white font-black tracking-wider px-4 flex items-center justify-between">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="currentColor">
                                        <path d="M424-56 0-480l424-424 80 81-343 343 343 343-80 81Z"/>
                                    </svg>
                                    <div>BACK</div>
                                    <div class="w-6"></div>
                                </button>
                            @endif
                        </div>
                    {{-- CONTROLS --}}

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            // $('#submitButton').on('click', function(){
            //     $('#submitModal').removeClass('hidden');
            // });

            // $('.closeSubmitModal').on('click', function(){
            //     $('#submitModal').addClass('hidden');
            // });
        });
    </script>
@endsection
