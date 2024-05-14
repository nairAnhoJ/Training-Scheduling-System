@extends('layouts.app')
@section('title','SURVEY')
@section('content')

    <div class="w-full p-5 bg-gray-200">
        <div class="bg-white rounded-xl shadow-xl">
            <div class="h-full rounded-xl">
                <form action="{{ route('attendeeSurveySubmit') . '?key=' . $key . '&a=' . $akey }}" method="POST" class="flex flex-col p-5">
                    @csrf
                    
                    {{-- CONTENT --}}
                        <div id="content" class="">
                            @if ($is_submitted == 0)
                                <div class="w-full">
                                    @foreach ($questions as $index => $question)
                                        @if ($question->type == 'MultipleChoice')
                                            <div class="mb-3">
                                                <p class="text-lg font-medium mb-1">{{ ($index+1) .'. '. $question->question }}</p>
                                                <div class="flex flex-col gap-y-[2px]">
                                                    @php
                                                        $options = explode(';', $question->options);
                                                    @endphp
                                                    @foreach ($options as $optionIndex => $option)
                                                        <div class="flex items-center">
                                                            <input id="option{{$index.$optionIndex}}" type="radio" value="{{$option}}" name="answer{{$index}}" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                                            <label for="option{{$index.$optionIndex}}" class="ms-2 text-sm text-gray-900">{{ucfirst($option)}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @elseif ($question->type == 'ShortAnswer')
                                            <div class="mb-3">
                                                <p class="text-lg font-medium mb-1">{{ ($index+1) .'. '. $question->question }}</p>
                                                <div class="flex flex-col gap-y-3">
                                                    <div class="w-full">
                                                        <textarea id="answer{{$index}}" name="answer{{$index}}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5 h-[120px] resize-none" autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="w-full h-[calc(100vh-136px)]">
                                    <div class="w-full h-full flex flex-col items-center justify-center">
                                        <div class="bg-emerald-500 p-8 rounded-full text-white my-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 " viewBox="0 -960 960 960" fill="currentColor">
                                                <path d="M382-208 122-468l90-90 170 170 366-366 90 90-456 456Z"/>
                                            </svg>
                                        </div>
                                        <p class="text-center text-2xl font-bold">Survey Submitted</p>
                                        <p class="text-center text-lg mb-5">We appreciate your feedback!</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    {{-- CONTENT --}}
                        
                    {{-- CONTROLS --}}
                        @if ($is_submitted == 0)
                            <div id="controlDiv" class="w-full mt-5">
                                <button id="submitButton" class="h-12 w-full border rounded-xl bg-blue-500 text-white font-black tracking-wider px-4 flex items-center justify-between">
                                    <div class="w-6"></div>
                                    <div>SUBMIT</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="currentColor">
                                        <path d="m304-58-80-81 343-343-343-343 80-81 424 424L304-58Z"/>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    {{-- CONTROLS --}}

                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
