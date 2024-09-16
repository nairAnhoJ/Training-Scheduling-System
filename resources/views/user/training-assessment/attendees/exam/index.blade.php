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
                    
                    <input type="hidden" value="-1" id="question">
                    <input type="hidden" value="{{ $exam->id }}" id="exam">
                    @csrf
                    
                    {{-- HEADER --}}
                        <div id="progressBar" class="hidden w-full pt-5 flex items-center flex-col px-5">
                            <div class="flex justify-between w-full items-center mb-2">
                                <div class="w-14"></div>
                                <p class=""><span id="curQ"></span> of {{ $exam->questions->count() }}</p>
                                <div id="timeRemaining" class="w-14 text-right"></div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4">
                                <div id="currentPBar" class="bg-blue-600 h-1.5 rounded-full" style="width: {{ (1 / $exam->questions->count()) * 100 }}%"></div>
                            </div>
                        </div>
                    {{-- HEADER --}}
                    
                    {{-- CONTENT --}}
                        <div id="content" class="h-[calc(100%-88px)] relative overflow-y-auto {{ ($attendee->written_score != null) ? '' : 'px-5' }}">

                            {{-- MULTIPLE CHOICE / TRUE or FALSE --}}
                                {{-- <div class="hidden h-full">
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
                                </div> --}}
                            {{-- MULTIPLE CHOICE / TRUE or FALSE --}}

                            {{-- SHORT ANSWER / ENUMERATION --}}
                                {{-- <div class="hidden h-full">
                                    <p class="text-xl font-bold mb-10">1. It is used to buckle up before starting the unit, which prevents accidents if the forklift gets tip over or side roll during operation.</p>
                                    <div class="flex flex-col gap-y-3">
                                        <div class="w-full">
                                            <input type="text" id="answer1" name="answer1" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                        </div>
                                        <div class="w-full">
                                            <input type="text" id="answer2" name="answer2" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- SHORT ANSWER / ENUMERATION --}}

                            {{-- RESULT / MAIN --}}
                                @if ($attendee->written_score != null)
                                    <div class="h-full flex items-center flex-col justify-between">
                                        <div class="w-full">
                                            @php
                                                $rate = ($attendee->written_score / $total)
                                            @endphp
                                            @if ($rate >= 0.5)
                                                <div class="bg-emerald-500 w-full text-center rounded-t-lg py-2 text-white flex items-center justify-center h-12">
                                                    <p class="text-emerald-500 bg-white rounded-full aspect-square w-7 h-7 mr-2 flex items-center justify-center">✓</p>
                                                    Exam Passed
                                                </div>
                                            @else
                                                <div class="bg-red-500 w-full text-center rounded-t-lg py-2 text-white flex items-center justify-center h-12">
                                                    <p class="text-red-500 bg-white rounded-full aspect-square w-7 h-7 mr-2 flex items-center justify-center">✗</p>
                                                    Exam Failed
                                                </div>
                                            @endif
                                            <div class="font-bold text-4xl tracking-wider text-center mt-5">{{ $exam->name }}</div>
                                        </div>

                                        <div class="font-bold text-6xl bg-white border-[15px] border-neutral-800 aspect-square rounded-full w-full text-neutral-800 relative max-w-[275px]">
                                            <p class="absolute top-1/2 left-1/2 -translate-x-full -translate-y-full pr-2">{{ $attendee->written_score }}</p>
                                            <p class=" text-9xl absolute top-1/2 font-medium left-1/2 -translate-x-1/2 -translate-y-1/2">/</p>
                                            <p class="absolute top-1/2 left-1/2 pl-2">{{ $total }}</p>
                                        </div>

                                        <div class="font-bold text-2xl tracking-wider text-center mb-5">{{ $attendee->name }}</div>
                                    </div>
                                @else
                                    <div id="main" class=" h-full grid grid-cols-1 sm:grid-cols-1 grid-rows-3 text-center">
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
                                @endif
                            {{-- RESULT / MAIN --}}

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
            var q = -1;
            var _token = $('input[name="_token"]').val();
            var mq = {{ $exam->questions->count() }};
            var key = "{{ $key }}";
            var akey = "{{ $akey }}";
            var start = new Date("{{ $attendee->written_exam_start }}");
            var end = new Date("{{ $attendee->written_exam_start }}");
            end.setMinutes(end.getMinutes() + 30);
            var timeRemaining;
            var score = "{{ $attendee->written_score }}";
            var questionSequence = @json($questionSequence);
            var answer = null;
            var qtype = null;
            

            $('#nextButton').click(function(){
                $('#loading').removeClass('hidden');
                q = $('#question').val();
                qtype = jQuery('#qtype').val();

                if(qtype == 'multiplechoice'){
                    answer = $('input[name="answer"]:checked').val();
                }else if(qtype == 'multipleselect'){
                    answer = [];
                    $('input[name="answer[]"]:checked').each(function() {
                        answer.push($(this).val());
                    });
                }else if(qtype == 'enumeration'){
                    answer = $('input[name="answer[]"]').map(function() {
                        return $(this).val();
                    }).get();
                }else if(qtype == 'shortanswer'){
                    answer = $('input[name="answer"]').val();
                }

                $.ajax({
                    url:"{{ route('npQuestion') }}",
                    method:"POST",
                    data:{
                        key: key,
                        akey: akey,
                        questionSequence: questionSequence,
                        q: q,
                        answer: answer,
                        nob: 'NEXT',
                        _token: _token
                    },
                    success:function(result){
                        $('#content').html(result);
                        $('#question').val(++q);

                        if((q+1) == mq){
                            $('#nextButton').addClass('hidden');
                            $('#submitButton').removeClass('hidden');
                        }else{
                            $('#backButton').removeClass('hidden');
                            $('#nsLabel').html('NEXT');
                        }
                        if(q > -1){
                            $('#progressBar').removeClass('hidden');
                            var curPB = (((q+1)/mq)*100)+'%';
                            $('#currentPBar').css('width', curPB);
                            $('#curQ').html(q+1);
                        }
                        
                        if(end == null || end == '' || end == 'Invalid Date'){
                            end = new Date();
                            end.setMinutes(end.getMinutes() + 30);
                        }

                        $('#loading').addClass('hidden');
                    }
                });
            });

            $('#backButton').click(function(){
                $('#loading').removeClass('hidden');
                q = $('#question').val();
                qtype = jQuery('#qtype').val();

                if(qtype == 'multiplechoice'){
                    answer = $('input[name="answer"]:checked').val();
                }else if(qtype == 'multipleselect'){
                    answer = [];
                    $('input[name="answer[]"]:checked').each(function() {
                        answer.push($(this).val());
                    });
                }else if(qtype == 'enumeration'){
                    answer = $('input[name="answer[]"]').map(function() {
                        return $(this).val();
                    }).get();
                }else if(qtype == 'shortanswer'){
                    answer = $('input[name="answer"]').val();
                }

                $.ajax({
                    url:"{{ route('npQuestion') }}",
                    method:"POST",
                    data:{
                        key: key,
                        akey: akey,
                        questionSequence: questionSequence,
                        q: q,
                        answer: answer,
                        nob: 'BACK',
                        _token: _token
                    },
                    success:function(result){
                        $('#content').html(result);
                        $('#question').val(--q);

                        if(q == 0){
                            $('#backButton').addClass('hidden');
                            $('#nsLabel').html('START');
                        }else{
                            $('#nextButton').removeClass('hidden');
                            $('#submitButton').addClass('hidden');
                        }
                        if(q > -1){
                            $('#progressBar').removeClass('hidden');
                            var curPB = (((q+1)/mq)*100)+'%';
                            $('#currentPBar').css('width', curPB);
                            $('#curQ').html(q+1);
                        }
                        $('#loading').addClass('hidden');
                    }
                });
            });

            $('#submitButton').on('click', function(){
                $('#submitModal').removeClass('hidden');
            });

            $('.closeSubmitModal').on('click', function(){
                $('#submitModal').addClass('hidden');
            });

            $('#ConfirmSubmitButton').click(function(){
                $('#loading').removeClass('hidden');
                q = $('#question').val();
                qtype = jQuery('#qtype').val();

                if(qtype == 'multiplechoice'){
                    answer = $('input[name="answer"]:checked').val();
                }else if(qtype == 'multipleselect'){
                    answer = [];
                    $('input[name="answer[]"]:checked').each(function() {
                        answer.push($(this).val());
                    });
                }else if(qtype == 'enumeration'){
                    answer = $('input[name="answer[]"]').map(function() {
                        return $(this).val();
                    }).get();
                }else if(qtype == 'shortanswer'){
                    answer = $('input[name="answer"]').val();
                }

                $.ajax({
                    url:"{{ route('npQuestion') }}",
                    method:"POST",
                    data:{
                        key: key,
                        akey: akey,
                        q: q,
                        questionSequence: questionSequence,
                        nob: 'SUBMIT',
                        answer: answer,
                        _token: _token
                    },
                    success:function(result){
                        location.reload(true);
                    }
                });
            });

            $('#resultSummaryButton').click(function(){
                $('#loading').removeClass('hidden');

                $.ajax({
                    url:"{{ route('resultSummary') }}",
                    method:"POST",
                    data:{
                        key: key,
                        akey: akey,
                        _token: _token
                    },
                    success:function(result){
                        $('#content').html(result);
                        $('#loading').addClass('hidden');
                        $('#controlDiv').addClass('hidden');
                        $('#content').removeClass('h-[calc(100%-88px)]');
                    }
                });
            });

            jQuery(document).on("click", "#backResultButton", function() {
                location.reload(true);
            });

            jQuery(document).on("change", ".inputRadio", function() {
                optionChanged();
            });

            jQuery(document).on("click", ".optionDiv", function() {
                $(this).children('input').prop('checked', true);
                optionChanged();
            });

            jQuery(document).on("click", ".selectOptionDiv", function() {
                $(this).children('input').prop('checked', function(i, value) {
                    return !value;
                });
                
                $('input[name="answer[]"]').parent().removeClass('border-2 border-blue-400 border border-neutral-100');
                $('input[name="answer[]"]').parent().addClass('border border-neutral-100');
                $('input[name="answer[]"]:checked').parent().removeClass('border border-neutral-100');
                $('input[name="answer[]"]:checked').parent().addClass('border-2 border-blue-400');
            });

            function optionChanged(){
                $('input[name="answer"]').parent().removeClass('border-2 border-blue-400 border border-neutral-100');
                $('input[name="answer"]').parent().addClass('border border-neutral-100');
                $('input[name="answer"]:checked').parent().removeClass('border border-neutral-100');
                $('input[name="answer"]:checked').parent().addClass('border-2 border-blue-400');
            }

            function updateTime() {
                var now = new Date();
                var diff = end - now;

                var seconds = Math.floor(diff / 1000);
                var minutes = Math.floor(seconds / 60);
                var hours = Math.floor(minutes / 60);

                hours = hours % 24;
                minutes = minutes % 60;
                seconds = seconds % 60;

                if(minutes <= 9){
                    minutes = '0'+minutes;
                }
                if(seconds <= 9){
                    seconds = '0'+seconds;
                }

                if(score == null || score == ''){
                    if(diff <= 0){
                        $('#ConfirmSubmitButton').click();
                    }else if(diff < 300000 && diff > 180000){
                        $("#timeRemaining").addClass('text-lg font-semibold');
                        $("#timeRemaining").text(minutes + ":" + seconds);
                    }else if(diff < 180000 && diff > 60000){
                        $("#timeRemaining").addClass('text-amber-700 text-xl font-semibold');
                        $("#timeRemaining").text(minutes + ":" + seconds);
                    }else if(diff < 60000){
                        $("#timeRemaining").addClass('text-red-700 text-2xl font-semibold');
                        $("#timeRemaining").text(minutes + ":" + seconds);
                    }else{
                        $("#timeRemaining").text(minutes + ":" + seconds);
                    }
                }

            }setInterval(updateTime, 1000);
        });
    </script>
@endsection
