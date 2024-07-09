@extends('layouts.app')
@section('title','DRIVING EXAM')
@section('content')

    <div class="w-full p-5 bg-gray-200">
        <div class="h-[calc(100vh-96px)] bg-white rounded-xl shadow-xl">
            <div class="h-full rounded-xl">
                <div class="h-full flex flex-col">
                    @csrf
                    
                    {{-- CONTENT --}}
                        <div id="content" class="h-[calc(100%)] relative overflow-y-auto {{ ($attendee->written_score != null) ? '' : 'px-5' }}">
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
                                                    <p class="absolute text-sm pl-1 pt-1 w-12">Deduction:</p>
                                                    <input 
                                                    disabled
                                                    value="{{ ($driving_score != null) ? (10 - $driving_score->seatbelt) : '' }}"
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
                                                    <p class="absolute text-sm pl-1 pt-1 w-12">Deduction:</p>
                                                    <input 
                                                    disabled
                                                    value="{{ ($driving_score != null) ? (5 - $driving_score->contact) : '' }}"
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
                                                    <p class="absolute text-sm pl-1 pt-1 w-12">Deduction:</p>
                                                    <input
                                                    disabled
                                                    value="{{ ($driving_score != null) ? (10 - $driving_score->horns) : '' }}"
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
                                                    <p class="absolute text-sm pl-1 pt-1 w-12">Deduction:</p>
                                                    <input
                                                    disabled
                                                    value="{{ ($driving_score != null) ? (5 - $driving_score->skid) : '' }}"
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
                                                    <p class="absolute text-sm pl-1 pt-1 w-12">Deduction:</p>
                                                    <input
                                                    disabled
                                                    value="{{ ($driving_score != null) ? (30 - $driving_score->controls) : '' }}"
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
                                                    <p class="absolute text-sm pl-1 pt-1 w-12">Deduction:</p>
                                                    <input
                                                    disabled
                                                    value="{{ ($driving_score != null) ? (20 - $driving_score->handling) : '' }}"
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
                                                    <p class="absolute text-sm pl-1 pt-1 w-12">Deduction:</p>
                                                    <input
                                                    disabled
                                                    value="{{ ($driving_score != null) ? (10 - $driving_score->behavior) : '' }}"
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
                                                    <p class="absolute text-sm pl-1 pt-1 w-12">Deduction:</p>
                                                    <input
                                                    disabled
                                                    value="{{ ($driving_score != null) ? (10 - $driving_score->time) : '' }}"
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
                                </div>
                            </div>
                        </div>
                    {{-- CONTENT --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
