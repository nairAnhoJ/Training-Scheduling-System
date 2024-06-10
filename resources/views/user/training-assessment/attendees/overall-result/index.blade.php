@extends('layouts.app')
@section('title','OVERALL RESULT')
@section('content')

    <div class="w-full p-5 bg-gray-200">
        <div class="h-[calc(100vh-96px)] bg-white rounded-xl shadow-xl">
            <div class="h-full rounded-xl">
                <div class="h-full flex flex-col">
                    @csrf
                    
                    {{-- CONTENT --}}
                        <div id="content" class="h-[calc(100%)] relative overflow-y-auto {{ ($attendee->written_score != null) ? '' : 'px-5' }}">
                            <div class="h-full w-full flex flex-col">
                                <div class="w-full p-5">
                                    <h1 class="font-bold text-center">{{ $attendee->name }}</h1>
                                    <div class="w-full max-w-[310px] relative aspect-square mt-10">
                                        <h1 class="absolute top-0 left-1/2 -translate-x-1/2 font-bold text-neutral-600 ">Written Exam</h1>
                                        <canvas id="chart" class="w-full h-[450px] absolute pointer-events-none"></canvas>
                                        <h1 id="writtenExamScore" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-5xl font-bold text-neutral-600"></h1>
                                        <h1 class="outOf absolute bottom-0 left-1/2 -translate-x-1/2 font-bold text-neutral-600 opacity-0 transition-all duration-1000">out of 100</h1>
                                    </div>
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
            var writtenExamScore = Number({{ $attendee->written_score }});
            var writtenExamTotal = Number({{ $exam_total }});
            var writtenExamDifference = writtenExamTotal - writtenExamScore;
            if((writtenExamScore / writtenExamTotal) > 0.85){
                var writtenExamColor = '#22C462';
            }else{
                var writtenExamColor = '#E34B50';
            }

            console.log(writtenExamTotal);
            console.log(writtenExamScore);
            console.log(writtenExamDifference);

            new Chart(document.getElementById("chart"), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        backgroundColor: [writtenExamColor, "#CDD3D6"],
                        data: [writtenExamScore, writtenExamDifference]
                    }]
                },
                options: {
                    rotation: -225 * (Math.PI / 180),
                    circumference: Math.PI * 1.5,
                    responsive: true,
                    cutout: '0',
                }
            });

            let count = 0;
            const intervalWritten = setInterval(function() {
                count++;
                $('#writtenExamScore').html(count);
                if (count == writtenExamScore) {
                    clearInterval(intervalWritten);
                    $('.outOf').html('out of ' + writtenExamTotal);
                    $('.outOf').removeClass('opacity-0');
                    $('.outOf').addClass('opacity-100');
                }
            }, 10);

        });
    </script>
@endsection
