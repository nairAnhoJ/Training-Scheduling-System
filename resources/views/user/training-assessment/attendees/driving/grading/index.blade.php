@extends('layouts.app')
@section('title','DRIVING EXAM')
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
                            <p class="italic text-sm">Once you submit this, you cannot make any further changes or undo your submission.</p>
                            <p class="mt-1 italic text-sm">Please review the scores carefully before submitting.</p>

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
                <form id="drivingExamSubmit" action="{{ route('driving.exam.submit').'?key='.$key.'&a='.$attendee->key }}" method="POST" class="h-full flex flex-col">
                    @csrf

                    {{-- CONTENT --}}
                        <div id="content" class="h-full w-full {{ ($attendee->driving_exam != null) ? '' : '' }}">
                            <div class="h-full w-full flex flex-col">
                                <div class="w-full h-2/5 p-5 border-b flex rounded-t-xl items-center justify-center shadow shadow-neutral-300">
                                    <img src="{{ asset("storage/".$dexams->layout) }}" alt="{{ $dexams->name.'_layout' }}" class="h-full w-auto">
                                </div>
                                <div class="w-full h-3/5 overflow-y-scroll p-5">
                                    <h1 class="font-bold"><span class="font-normal">Name: </span>{{ $attendee->name }}</h1>

                                    <h1 class="font-bold mt-5 mb-1">Penalty Points Chart</h1>
                                    {{-- PPC --}}
                                        <div class="w-full border border-neutral-600 text-sm mb-5">
                                            <div class="flex items-center w-full border-b border-neutral-600">
                                                <p class="font-bold w-1/2 pl-1 border-r border-neutral-600 pt-1">Maneuvering</p>
                                                <p class="text-center w-1/2 pt-1">Deduction pts.</p>
                                            </div>
                                            <div class="flex w-full items-center border-b border-neutral-600">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Low Impact</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                            <div class="flex w-full items-center border-b border-neutral-600">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Medium</p>
                                                <p class="text-center w-1/2 pt-1">3</p>
                                            </div>
                                            <div class="flex w-full items-center border-b border-neutral-600">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • High Impact</p>
                                                <p class="text-center w-1/2 pt-1">5</p>
                                            </div>
                                            <div class="flex w-full items-center">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Direction</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                        </div>
                                        
                                        <div class="w-full border border-neutral-600 text-sm mb-5">
                                            <div class="flex items-center w-full border-b border-neutral-600">
                                                <p class="font-bold w-1/2 pl-1 border-r border-neutral-600 pt-1">Handling</p>
                                                <p class="text-center w-1/2 pt-1">Deduction pts.</p>
                                            </div>
                                            <div class="flex w-full items-center border-b border-neutral-600">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Misalign</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                            <div class="flex w-full items-center border-b border-neutral-600">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Load Level</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                            <div class="flex w-full items-center border-b border-neutral-600">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Hitting Barrier</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                            <div class="flex w-full items-center">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Fork Condition</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                        </div>

                                        <div class="w-full border border-neutral-600 text-sm mb-5">
                                            <div class="flex items-center w-full border-b border-neutral-600">
                                                <p class="font-bold w-1/2 pl-1 border-r border-neutral-600 pt-1">Behavior</p>
                                                <p class="text-center w-1/2 pt-1">Deduction pts.</p>
                                            </div>
                                            <div class="flex w-full items-center border-b border-neutral-600">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Sudden Brake</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                            <div class="flex w-full items-center border-b border-neutral-600">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Walk Around</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                            <div class="flex w-full items-center border-b border-neutral-600">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Body Parts Out</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                            <div class="flex w-full items-center border-b border-neutral-600">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Accel Pedal</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                            <div class="flex w-full items-center">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Inching Pedal</p>
                                                <p class="text-center w-1/2 pt-1">1</p>
                                            </div>
                                        </div>

                                        <div class="w-full border border-neutral-600 text-sm mb-5">
                                            <div class="flex items-center w-full border-b border-neutral-600">
                                                <p class="font-bold w-1/2 pl-1 border-r border-neutral-600 pt-1">Time</p>
                                                <p class="text-center w-1/2 pt-1">Deduction pts.</p>
                                            </div>
                                            <div class="flex w-full items-center">
                                                <p class="w-1/2 pl-1 border-r border-neutral-600 pt-1"> • Time Overrun</p>
                                                <p class="text-center w-1/2 pt-1">10</p>
                                            </div>
                                        </div>
                                    {{-- PPC --}}

                                    <hr class="w-full px-5 mt-8 border-neutral-400">

                                    <h1 class="font-bold mt-7">ACTUAL</h1>

                                    <h1 class="font-bold mt-3">Safety Awareness(30pts.)</h1>
                                    {{-- SA --}}
                                        <div class="mt-1">
                                            <p class="pl-2 font-semibold text-sm">• Seatbelt</p>
                                            <div class="w-full mx-2 text-sm flex border border-neutral-600">
                                                <p class="w-1/2 border-0 pl-1 pt-1">Max Deduction: <span class="font-semibold">10</span></p>
                                                <div class="w-1/2 border-l border-neutral-600 gap-x-1 relative">
                                                    <p class="absolute text-sm pl-1 pt-1">Deduction:</p>
                                                    <input 
                                                    {{ ($attendee->driving_score != null) ? 'disabled' : '' }} 
                                                    value="{{ ($attendee->driving_score != null) ? (10 - $driving_score->seatbelt) : old('seatbelt') }}"
                                                    name="seatbelt" class="numberOnly text-sm p-0 border-0 w-full pt-1 pl-[85px]" type="text" autocomplete="off">
                                                </div>
                                            </div>
                                            @error('seatbelt')
                                                <span class="text-xs text-red-500 mx-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mt-1">
                                            <p class="pl-2 font-semibold text-sm">• 3pt Contact</p>
                                            <div class="w-full mx-2 text-sm flex border border-neutral-600">
                                                <p class="w-1/2 border-0 pl-1 pt-1">Max Deduction: <span class="font-semibold">5</span></p>
                                                <div class="w-1/2 border-l border-neutral-600 gap-x-1 relative">
                                                    <p class="absolute text-sm pl-1 pt-1">Deduction:</p>
                                                    <input 
                                                    {{ ($attendee->driving_score != null) ? 'disabled' : '' }} 
                                                    value="{{ ($attendee->driving_score != null) ? (5 - $driving_score->contact) : old('contact') }}"
                                                    name="contact" class="numberOnly text-sm p-0 border-0 w-full pt-1 pl-[85px]" type="text" autocomplete="off">
                                                </div>
                                            </div>
                                            @error('contact')
                                                <span class="text-xs text-red-500 mx-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mt-1">
                                            <p class="pl-2 font-semibold text-sm">• Horns</p>
                                            <div class="w-full mx-2 text-sm flex border border-neutral-600">
                                                <p class="w-1/2 border-0 pl-1 pt-1">Max Deduction: <span class="font-semibold">10</span></p>
                                                <div class="w-1/2 border-l border-neutral-600 gap-x-1 relative">
                                                    <p class="absolute text-sm pl-1 pt-1">Deduction:</p>
                                                    <input
                                                    {{ ($attendee->driving_score != null) ? 'disabled' : '' }} 
                                                    value="{{ ($attendee->driving_score != null) ? (10 - $driving_score->horns) : old('horns') }}"
                                                    name="horns" class="numberOnly text-sm p-0 border-0 w-full pt-1 pl-[85px]" type="text" autocomplete="off">
                                                </div>
                                            </div>
                                            @error('horns')
                                                <span class="text-xs text-red-500 mx-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mt-1">
                                            <p class="pl-2 font-semibold text-sm">• Skid</p>
                                            <div class="w-full mx-2 text-sm flex border border-neutral-600">
                                                <p class="w-1/2 border-0 pl-1 pt-1">Max Deduction: <span class="font-semibold">5</span></p>
                                                <div class="w-1/2 border-l border-neutral-600 gap-x-1 relative">
                                                    <p class="absolute text-sm pl-1 pt-1">Deduction:</p>
                                                    <input
                                                    {{ ($attendee->driving_score != null) ? 'disabled' : '' }} 
                                                    value="{{ ($attendee->driving_score != null) ? (5 - $driving_score->skid) : old('skid') }}"
                                                    name="skid" class="numberOnly text-sm p-0 border-0 w-full pt-1 pl-[85px]" type="text" autocomplete="off">
                                                </div>
                                            </div>
                                            @error('skid')
                                                <span class="text-xs text-red-500 mx-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    {{-- SA --}}

                                    <h1 class="font-bold mt-3">Driving Operation(70pts.)</h1>
                                    {{-- DO --}}
                                        <div class="mt-1">
                                            <p class="pl-2 font-semibold text-sm">• Maneuvering</p>
                                            <div class="w-full mx-2 text-sm flex border border-neutral-600">
                                                <p class="w-1/2 border-0 pl-1 pt-1">Max Deduction: <span class="font-semibold">30</span></p>
                                                <div class="w-1/2 border-l border-neutral-600 gap-x-1 relative">
                                                    <p class="absolute text-sm pl-1 pt-1">Deduction:</p>
                                                    <input
                                                    {{ ($attendee->driving_score != null) ? 'disabled' : '' }} 
                                                    value="{{ ($attendee->driving_score != null) ? (30 - $driving_score->controls) : old('controls') }}"
                                                    name="controls" class="numberOnly text-sm p-0 border-0 w-full pt-1 pl-[85px]" type="text" autocomplete="off">
                                                </div>
                                            </div>
                                            @error('controls')
                                                <span class="text-xs text-red-500 mx-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mt-1">
                                            <p class="pl-2 font-semibold text-sm">• Handling</p>
                                            <div class="w-full mx-2 text-sm flex border border-neutral-600">
                                                <p class="w-1/2 border-0 pl-1 pt-1">Max Deduction: <span class="font-semibold">20</span></p>
                                                <div class="w-1/2 border-l border-neutral-600 gap-x-1 relative">
                                                    <p class="absolute text-sm pl-1 pt-1">Deduction:</p>
                                                    <input
                                                    {{ ($attendee->driving_score != null) ? 'disabled' : '' }} 
                                                    value="{{ ($attendee->driving_score != null) ? (20 - $driving_score->handling) : old('handling') }}"
                                                    name="handling" class="numberOnly text-sm p-0 border-0 w-full pt-1 pl-[85px]" type="text" autocomplete="off">
                                                </div>
                                            </div>
                                            @error('handling')
                                                <span class="text-xs text-red-500 mx-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mt-1">
                                            <p class="pl-2 font-semibold text-sm">• Behavior</p>
                                            <div class="w-full mx-2 text-sm flex border border-neutral-600">
                                                <p class="w-1/2 border-0 pl-1 pt-1">Max Deduction: <span class="font-semibold">10</span></p>
                                                <div class="w-1/2 border-l border-neutral-600 gap-x-1 relative">
                                                    <p class="absolute text-sm pl-1 pt-1">Deduction:</p>
                                                    <input
                                                    {{ ($attendee->driving_score != null) ? 'disabled' : '' }} 
                                                    value="{{ ($attendee->driving_score != null) ? (10 - $driving_score->behavior) : old('behavior') }}"
                                                    name="behavior" class="numberOnly text-sm p-0 border-0 w-full pt-1 pl-[85px]" type="text" autocomplete="off">
                                                </div>
                                            </div>
                                            @error('behavior')
                                                <span class="text-xs text-red-500 mx-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mt-1">
                                            <p class="pl-2 font-semibold text-sm">• Time</p>
                                            <div class="w-full mx-2 text-sm flex border border-neutral-600">
                                                <p class="w-1/2 border-0 pl-1 pt-1">Max Deduction: <span class="font-semibold">10</span></p>
                                                <div class="w-1/2 border-l border-neutral-600 gap-x-1 relative">
                                                    <p class="absolute text-sm pl-1 pt-1">Deduction:</p>
                                                    <input
                                                    {{ ($attendee->driving_score != null) ? 'disabled' : '' }} 
                                                    value="{{ ($attendee->driving_score != null) ? (10 - $driving_score->time) : old('time') }}"
                                                    name="time" class="numberOnly text-sm p-0 border-0 w-full pt-1 pl-[85px]" type="text" autocomplete="off">
                                                </div>
                                            </div>
                                            @error('time')
                                                <span class="text-xs text-red-500 mx-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    {{-- DO --}}            

                                    @if ($driving_score != null)
                                        <h1 class="font-bold mt-5">Total Score: <span class="ms-3 text-lg">{{ $attendee->driving_score }}</span> out of 100</h1>
                                    @else
                                        <h1 class="font-bold mt-5">Total Score: </h1>
                                    @endif
                                    
                                    {{-- CONTROLS --}}
                                        <div id="controlDiv" class="w-full mt-5">
                                            @if($attendee->driving_score == null)
                                                <button id="submitButton" type="button" class="h-12 w-full border rounded-xl bg-blue-500 text-white font-bold tracking-wider px-4 flex items-center justify-center">
                                                    <div>SUBMIT</div>
                                                </button>
                                            @endif
                                            <a href="{{ url('/training-assessment/attendees').'?key='.$key }}" id="backButton" class="h-12 mt-2 w-full border rounded-xl bg-neutral-100 border-neutral-800 text-neutral-800 font-bold tracking-wider px-4 flex items-center justify-center">
                                                <div>BACK</div>
                                            </a>
                                        </div>
                                    {{-- CONTROLS --}}
                                </div>
                            </div>
                        </div>
                    {{-- CONTENT --}}

                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#submitButton').on('click', function(){
                $('#submitModal').removeClass('hidden');
            });

            $('.closeSubmitModal').on('click', function(){
                $('#submitModal').addClass('hidden');
            });

            $('#ConfirmSubmitButton').on('click', function(){
                $('#drivingExamSubmit').submit();
            });
        });
    </script>
@endsection
