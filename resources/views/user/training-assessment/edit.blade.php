@extends('layouts.app')
@section('title','ATTENDEES - EDIT')
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


    <div class="w-full p-5 bg-gray-200">
        <div class="min-h-[calc(100vh-96px)] p-3 bg-white rounded-lg shadow-xl">
            <div class="p-4 overflow-hidden rounded-lg">
                <form method="POST" action="{{ route('attendees.update').'?key='.$key.'&a='.$attendee->key }}">
                    @csrf
                    <input type="hidden" name="key" value="{{ $key }}">
                    <div class="w-full mb-3">
                        <label for="name" class="block text-sm font-semibold text-gray-600">Name <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ $attendee->name }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                        @error('name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-3">
                        <label for="position" class="block text-sm font-semibold text-gray-600">Position <span class="text-red-500">*</span></label>
                        <input type="text" id="position" name="position" value="{{ $attendee->position }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                        @error('position')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-3">
                        <label for="type" class="block text-sm font-semibold text-gray-600">Type of unit operated <span class="text-red-500">*</span></label>
                        <div class="flex">
                            <div class="flex items-center w-1/2">
                                <input {{ ($attendee->type == 'CBE') ? 'checked' : '' }} id="CBE" type="radio" value="CBE" name="type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="CBE" class="ms-2 text-sm font-medium text-gray-900">CBE</label>
                            </div>
                            <div class="flex items-center w-1/2">
                                <input {{ ($attendee->type == 'CBD') ? 'checked' : '' }} id="CBD" type="radio" value="CBD" name="type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="CBD" class="ms-2 text-sm font-medium text-gray-900">CBD</label>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex items-center w-1/2">
                                <input {{ ($attendee->type == 'CBG/LPG') ? 'checked' : '' }} id="CBG/LPG" type="radio" value="CBG/LPG" name="type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="CBG/LPG" class="ms-2 text-sm font-medium text-gray-900">CBG/LPG</label>
                            </div>
                            <div class="flex items-center w-1/2">
                                <input {{ ($attendee->type == 'RT') ? 'checked' : '' }} id="RT" type="radio" value="RT" name="type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="RT" class="ms-2 text-sm font-medium text-gray-900">RT</label>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex items-center w-1/2">
                                <input {{ ($attendee->type == 'PPT') ? 'checked' : '' }} id="PPT" type="radio" value="PPT" name="type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="PPT" class="ms-2 text-sm font-medium text-gray-900">PPT</label>
                            </div>
                        </div>
                        @error('type')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-3">
                        <label for="knowledge" class="block text-sm font-semibold text-gray-600">Knowledge <span class="text-red-500">*</span></label>
                        <div class="flex-col">
                            <div class="flex items-center">
                                <input {{ ($attendee->knowledge == 'With Experience') ? 'checked' : '' }} id="With Experience" type="radio" value="With Experience" name="knowledge" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="With Experience" class="ms-2 text-sm font-medium text-gray-900">With Experience</label>
                            </div>
                            <div class="flex items-center">
                                <input {{ ($attendee->knowledge == 'Without Experience') ? 'checked' : '' }} id="Without Experience" type="radio" value="Without Experience" name="knowledge" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="Without Experience" class="ms-2 text-sm font-medium text-gray-900">Without Experience</label>
                            </div>
                        </div>
                        @error('knowledge')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-3">
                        <label for="years_operating" class="block text-sm font-semibold text-gray-600">Years Operating Forklifts/MHE <span class="text-red-500">*</span></label>
                        <div class="flex w-full gap-x-2">
                            <button type="button" id="minusYear" class="text-red-500 flex justify-center items-center hover:scale-105">
                                <?xml version="1.0" encoding="utf-8"?>
                                <svg viewBox="80 -880 800 800" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor">
                                    <path d="M 280 -446 L 680 -446 L 680 -506 L 280 -506 L 280 -446 Z M 480.266 -80 C 425.11 -80 373.277 -90.5 324.766 -111.5 C 276.255 -132.5 233.833 -161.167 197.5 -197.5 C 161.167 -233.833 132.5 -276.28 111.5 -324.841 C 90.5 -373.401 80 -425.287 80 -480.5 C 80 -535.713 90.5 -587.599 111.5 -636.159 C 132.5 -684.72 161.167 -727 197.5 -763 C 233.833 -799 276.28 -827.5 324.841 -848.5 C 373.401 -869.5 425.287 -880 480.5 -880 C 535.713 -880 587.599 -869.5 636.159 -848.5 C 684.72 -827.5 727 -799 763 -763 C 799 -727 827.5 -684.667 848.5 -636 C 869.5 -587.333 880 -535.422 880 -480.266 C 880 -425.11 869.5 -373.277 848.5 -324.766 C 827.5 -276.255 799 -233.895 763 -197.684 C 727 -161.473 684.667 -132.807 636 -111.684 C 587.333 -90.561 535.422 -80 480.266 -80 Z M 480.5 -140 C 574.833 -140 655 -173.167 721 -239.5 C 787 -305.833 820 -386.167 820 -480.5 C 820 -574.833 787.063 -655 721.188 -721 C 655.313 -787 574.917 -820 480 -820 C 386 -820 305.833 -787.063 239.5 -721.188 C 173.167 -655.313 140 -574.917 140 -480 C 140 -386 173.167 -305.833 239.5 -239.5 C 305.833 -173.167 386.167 -140 480.5 -140 Z M 480 -480 Z"/>
                                </svg>
                            </button>
                            <input type="number" id="years_operating" name="years_operating" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block text-center px-0 py-2" autocomplete="off" value="{{ $attendee->years_operating }}" readonly>
                            <button type="button" id="addYear" class="text-blue-500 flex justify-center items-center hover:scale-105">
                                <?xml version="1.0" encoding="utf-8"?>
                                <svg viewBox="80 -880 800 800" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor">
                                    <path d="M453-280h60v-166h167v-60H513v-174h-60v174H280v60h173v166Zm27.266 200q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80-397.681 80-480.5q0-82.819 31.5-155.659Q143-709 197.5-763t127.341-85.5Q397.681-880 480.5-880q82.819 0 155.659 31.5Q709-817 763-763t85.5 127Q880-563 880-480.266q0 82.734-31.5 155.5T763-197.684q-54 54.316-127 86Q563-80 480.266-80Zm.234-60Q622-140 721-239.5t99-241Q820-622 721.188-721 622.375-820 480-820q-141 0-240.5 98.812Q140-622.375 140-480q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/>
                                </svg>
                            </button>
                        </div>
                        @error('years_operating')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2 mt-5 md:flex-row gap-x-8">
                        <button type="submit" class="w-full py-2 font-bold tracking-wider text-white bg-blue-500 rounded-lg hover:scale-[101%]">SAVE</button>
                        <a href="{{ route('attendees') . '?key=' . $key }}" class="w-full py-2 font-bold tracking-wider text-center text-white bg-gray-500 rounded-lg hover:scale-[101%]">BACK</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#minusYear').on('click', function(){
                var years_operating = $('#years_operating').val();
                if(years_operating>0){
                    $('#years_operating').val(Number(years_operating)-1);
                }
            });
            $('#addYear').on('click', function(){
                var years_operating = $('#years_operating').val();
                $('#years_operating').val(Number(years_operating)+1);
            });
        });
    </script>
@endsection
