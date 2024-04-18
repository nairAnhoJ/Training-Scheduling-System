@extends('layouts.app')
@section('title','WRITTEN EXAM')
@section('content')

    <div class="w-full p-5 bg-gray-200">
        <div class="h-[calc(100vh-108px)] p-3 bg-white rounded-lg shadow-xl">
            <div class="h-full p-4 overflow-hidden rounded-lg">
                <div class="h-full">
                    <input type="hidden" value="0" id="question">
                    @csrf
                    <div id="content" class="h-full">

                        {{-- MULTIPLE CHOICE / TRUE or FALSE --}}
                            <div class="hidden h-full">
                                <p class="text-xl font-bold mb-10">1. It is used to buckle up before starting the unit, which prevents accidents if the forklift gets tip over or side roll during operation.</p>
                                <div class="flex flex-col gap-y-2">
                                    <div class="flex items-center">
                                        <input checked id="option1" type="radio" value="a" name="answer" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="option1" class="ms-2 text-lg font-medium text-gray-900">Safety Shoes</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="option2" type="radio" value="b" name="answer" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="option2" class="ms-2 text-lg font-medium text-gray-900">Safety Helmet</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="option3" type="radio" value="c" name="answer" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="option3" class="ms-2 text-lg font-medium text-gray-900">Safety Belt</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="option4" type="radio" value="d" name="answer" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="option4" class="ms-2 text-lg font-medium text-gray-900">Safety Googles</label>
                                    </div>
                                </div>
                            </div>
                        {{-- MULTIPLE CHOICE / TRUE or FALSE --}}

                        {{-- SHORT ANSWER / ENUMERATION --}}
                            <div class="hidden h-full">
                                <p class="text-xl font-bold mb-10">1. It is used to buckle up before starting the unit, which prevents accidents if the forklift gets tip over or side roll during operation.</p>
                                <div class="flex flex-col gap-y-3">
                                    <div class="w-full">
                                        <input type="text" id="answer1" name="answer1" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                    </div>
                                    <div class="w-full">
                                        <input type="text" id="answer2" name="answer2" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        {{-- SHORT ANSWER / ENUMERATION --}}

                        {{-- MAIN --}}
                            <div id="main" class="h-full grid grid-cols-1 sm:grid-cols-1 grid-rows-3 text-center">
                                <div class="self-center">
                                    <p class="font-bold tracking-wide uppercase text-2xl">{{ $exam->name }}</p>
                                </div>
                                <div class="self-end">
                                    <p class="font-bold tracking-wide text-xl">{{ $attendee->name }}</p>
                                </div>
                                <div class="self-end">
                                    <p class="text-sm">Click "START" to start the exam.</p>
                                </div>
                            </div>
                        {{-- MAIN --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- CONTROLS --}}
            <div class="w-full mt-5 flex flex-row-reverse gap-x-4">
                <button id="submitButton" class="hidden h-12 w-full border rounded-full bg-blue-500 text-white font-black tracking-wider px-4 flex items-center justify-between">
                    <div class="w-6"></div>
                    <div>SUBMIT</div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="currentColor">
                        <path d="m304-58-80-81 343-343-343-343 80-81 424 424L304-58Z"/>
                    </svg>
                </button>
                <button id="nextButton" class="h-12 w-full border rounded-full bg-blue-500 text-white font-black tracking-wider px-4 flex items-center justify-between">
                    <div class="w-6"></div>
                    <div id="nsLabel">START</div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="currentColor">
                        <path d="m304-58-80-81 343-343-343-343 80-81 424 424L304-58Z"/>
                    </svg>
                </button>
                <button id="backButton" class="hidden h-12 w-full border rounded-full bg-blue-500 text-white font-black tracking-wider px-4 flex items-center justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="currentColor">
                        <path d="M424-56 0-480l424-424 80 81-343 343 343 343-80 81Z"/>
                    </svg>
                    <div>BACK</div>
                    <div class="w-6"></div>
                </button>
            </div>
        {{-- CONTROLS --}}
    </div>

    <script>
        $(document).ready(function(){
            var q = 0;
            var _token = $('input[name="_token"]').val();
            var mq = {{ $exam->questions->count() }};
            var key = "{{ $key }}";
            var akey = "{{ $akey }}";
            var answer = null;
            var qtype = null;

            $('#nextButton').click(function(){
                q = $('#question').val();
                $('#question').val(++q);

                $.ajax({
                    url:"{{ route('npQuestion') }}",
                    method:"POST",
                    data:{
                        key: key,
                        akey: akey,
                        q: q,
                        answer: answer,
                        _token: _token
                    },
                    success:function(result){
                        $('#generatedQR').html(result);
                        $('#generateModal').removeClass('hidden');
                    }
                });




                if(q == mq){
                    $('#nextButton').addClass('hidden');
                    $('#submitButton').removeClass('hidden');
                }else{
                    $('#backButton').removeClass('hidden');
                    $('#nsLabel').html('NEXT');
                }
            });

            $('#backButton').click(function(){
                q = $('#question').val();
                $('#question').val(--q);
                if(q == 0){
                    $('#backButton').addClass('hidden');
                    $('#nsLabel').html('START');
                }else{
                    $('#nextButton').removeClass('hidden');
                    $('#submitButton').addClass('hidden');
                }
            });
        });
    </script>
@endsection
