@extends('layouts.app')
@section('title', 'EXAM QUESTIONS')
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
                <form action="{{ route('question.update') . '?qid=' . $question->id . '&key=' . $key }}" method="POST" class="max-w-[500px]">
                    @csrf
                    <h2 class="mb-2 text-lg font-bold">EDIT QUESTION</h2>
                    <div class="mb-3">
                        <label for="type" class="block text-sm font-semibold text-gray-600">Type <span class="text-red-500">*</span></label>
                        <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option hidden value=""></option>
                            <option {{ ($question->type == 'MultipleChoice') ? 'selected' : '' }} value="MultipleChoice">Multiple Choice</option>
                            <option {{ ($question->type == 'ShortAnswer') ? 'selected' : '' }} value="ShortAnswer">Short Answer</option>
                            <option {{ ($question->type == 'TrueOrFalse') ? 'selected' : '' }} value="TrueOrFalse">True or False</option>
                            <option {{ ($question->type == 'Enumeration') ? 'selected' : '' }} value="Enumeration">Enumeration</option>
                        </select>
                        @error('type')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-3">
                        <label for="question" class="block text-sm font-semibold text-gray-600">Question <span class="text-red-500">*</span></label>
                        <textarea name="question" id="question" rows="3" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">{{ $question->question }}</textarea>
                        @error('question')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div id="optionsMainDiv" class=" {{ ($question->type == 'MultipleChoice') ? '' : 'hidden' }} w-full mb-3">
                        <div class="flex justify-between mb-2">
                            <label class="block text-sm font-semibold text-gray-600">Options <span class="text-red-500">*</span></label>
                            <button type="button" id="addOption" class="text-blue-500 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 -960 960 960" class="w-5 h-5">
                                    <script xmlns=""/>
                                        <path d="M447-274h72v-166h167v-72H519v-174h-72v174H274v72h173v166Zm33.404 219q-88.872 0-166.125-33.084-77.254-33.083-135.183-91.012-57.929-57.929-91.012-135.119Q55-391.406 55-480.362q0-88.957 33.084-166.285 33.083-77.328 90.855-134.809 57.772-57.482 135.036-91.013Q391.238-906 480.279-906q89.04 0 166.486 33.454 77.446 33.453 134.853 90.802 57.407 57.349 90.895 134.877Q906-569.34 906-480.266q0 89.01-33.531 166.247-33.531 77.237-91.013 134.86-57.481 57.623-134.831 90.891Q569.276-55 480.404-55Zm.096-94q137.5 0 234-96.372T811-480.5q0-137.5-96.312-234Q618.375-811 479.5-811q-137.5 0-234 96.312Q149-618.375 149-479.5q0 137.5 96.372 234T480.5-149Zm-.5-331Z"/>
                                    <script xmlns=""/>
                                </svg>
                            </button>
                        </div>
                        <div id="optionDiv">
                            @php
                                $choices = explode(',', $question->options);
                            @endphp
                            @foreach ($choices as $index => $choice)
                                <div class="flex items-center w-full gap-x-1 {{ ($index > 0) ? 'mt-2' : '' }}">
                                    <label for="option{{ $index+1 }}" class="block w-4 text-sm font-semibold text-gray-600">{{ chr(65+$index) }}.</label>
                                    <input type="text" id="option{{ $index+1 }}" name="option{{ $index+1 }}" value="{{ $choice }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-full mb-3">
                        <label for="answer" class="block text-sm font-semibold text-gray-600">Answer <span class="text-red-500">*</span></label>
                        <input type="text" id="answer" name="answer" value="{{ $question->answer }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                        @error('answer')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-3">
                        <label for="points" class="block text-sm font-semibold text-gray-600">Points <span class="text-red-500">*</span></label>
                        <input type="text" id="points" name="points" value="{{ $question->points }}" class="bg-gray-50 border numberOnly border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                        @error('points')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2 mt-5 md:flex-row gap-x-8">
                        <button type="submit" class="w-full py-2 font-bold tracking-wider text-white bg-blue-500 rounded-lg hover:scale-[101%]">SAVE</button>
                        <a href="{{ route('question.index') . '?key=' . $key }}" class="w-full py-2 font-bold tracking-wider text-center text-white bg-gray-500 rounded-lg hover:scale-[101%]">BACK</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var x = {{ count($choices)+1 }};
            var a = 64;
            $('#addOption').click(function(){
                if(x <= 10){
                    var letter = String.fromCharCode(x+a);
                    $('#optionDiv').append(`
                        <div class="flex items-center w-full mt-2 gap-x-1">
                            <label for="option${x}" class="block w-4 text-sm font-semibold text-gray-600">${letter}.</label>
                            <input type="text" id="option${x}" name="option${x}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                        </div>
                    `);
                    x++;
                }
            });

            $('#type').on('change', function(){
                var type = $(this).val();
                if(type === 'MultipleChoice'){
                    $('#optionsMainDiv').removeClass('hidden')
                }else{
                    $('#optionsMainDiv').addClass('hidden')
                }
            });
        });
    </script>
@endsection
