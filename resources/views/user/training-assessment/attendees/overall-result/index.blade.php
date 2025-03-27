@extends('layouts.app')
@section('title','OVERALL RESULT')
@section('content')

    <div class="w-full p-5 bg-gray-200">
        <div class="h-[calc(100vh-96px)] bg-white rounded-xl shadow-xl">
            <div class="h-full rounded-xl">
                <div class="h-full flex flex-col">
                    @csrf
                    {{-- CONTENT --}}
                        <div id="content" class="h-full relative overflow-y-auto {{ ($attendee->written_score != null) ? '' : 'px-5' }}">
                            <div class="h-full w-full">
                                <div class="w-full p-5 flex flex-col items-center">
                                    <h1 class="font-bold text-center">{{ $attendee->name }}</h1>
                                    <h1 id="resultAlert" class="text-4xl font-bold text-center mt-5"></h1>
                                    <div class="w-full max-w-[200px] relative aspect-square mt-5">
                                        <h1 class="absolute top-0 left-1/2 -translate-x-1/2 font-bold text-neutral-600 whitespace-nowrap">Written Exam</h1>
                                        <canvas id="written-chart" class="w-full h-full absolute pointer-events-none"></canvas>
                                        <h1 id="writtenExamScore" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-4xl font-bold text-neutral-600"></h1>
                                        <h1 class="writtenOutOf outOf absolute bottom-0 left-1/2 -translate-x-1/2 font-bold text-neutral-600 opacity-0 transition-all duration-1000"></h1>
                                    </div>

                                    @if ($training->billing_type == "CHARGEABLE")
                                        <div class="w-full max-w-[200px] relative aspect-square mt-7">
                                            <h1 class="absolute top-0 left-1/2 -translate-x-1/2 font-bold text-neutral-600 whitespace-nowrap">Driving Exam</h1>
                                            <canvas id="driving-chart" class="w-full h-full absolute pointer-events-none"></canvas>
                                            <h1 id="drivingExamScore" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-4xl font-bold text-neutral-600"></h1>
                                            <h1 class="drivingOutOf outOf absolute bottom-0 left-1/2 -translate-x-1/2 font-bold text-neutral-600 opacity-0 transition-all duration-1000">out of 100</h1>
                                        </div>
                                    @endif

                                    <div class="w-full max-w-[250px] relative aspect-square my-7">
                                        <h1 class="absolute top-0 left-1/2 -translate-x-1/2 font-bold text-neutral-600 whitespace-nowrap">Overall Result</h1>
                                        <canvas id="overall-result" class="w-full h-full absolute pointer-events-none"></canvas>
                                        <h1 class="absolute bottom-0 left-1/2 -translate-x-1/2 text-3xl font-bold text-neutral-600"><span id="overallResult" class="text-5xl"></span>%</h1>
                                        {{-- <h1 class="resultOutOf outOf absolute bottom-0 left-1/2 -translate-x-1/2 font-bold text-neutral-600 opacity-0 transition-all duration-1000">out of 100</h1> --}}
                                    </div>
                                    <div class="PassOrFail text-lg font-semibold uppercase text-gray-600"></div>
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
            var billing_type = "{{ $training->billing_type }}";
            console.log(billing_type);
            
            // Written
                var writtenExamScore = Number({{ $attendee->written_score }});
                var writtenExamTotal = Number({{ $exam_total }});
                var writingPercentage = (writtenExamScore / writtenExamTotal);
                var writtenExamDifference = writtenExamTotal - writtenExamScore;
                if(writingPercentage > 0.949){
                    var writtenExamColor = '#12B987';
                }else if((writingPercentage < 0.949) && (writingPercentage > 0.849)){
                    var writtenExamColor = '#F39E0E';
                }else{
                    var writtenExamColor = '#E64A4E';
                }
            // Written
            

            if(billing_type == "CHARGEABLE"){
                // Driving
                    var drivingExamScore = Number({{ $attendee->driving_score }});
                    var drivingExamTotal = 100;
                    var drivingPercentage = (drivingExamScore / drivingExamTotal);
                    var drivingExamDifference = drivingExamTotal - drivingExamScore;
                    if(drivingPercentage > 0.949){
                        var drivingExamColor = '#12B987';
                    }else if((drivingPercentage < 0.949) && (drivingPercentage > 0.849)){
                        var drivingExamColor = '#F39E0E';
                    }else{
                        var drivingExamColor = '#E64A4E';
                    }
                // Driving

                // Overall Result
                    var writtenPercent = 20 * (writtenExamScore / writtenExamTotal);
                    var drivingPercent = 80 * (drivingExamScore / 100);
                    var overallTotal = 100;
                    var overallScore = Math.round(writtenPercent + drivingPercent);
                    var overallPercentage = (overallScore / overallTotal);

                    var overallDifference = overallTotal - overallScore;

                    var PassOrFail = 'PASSED';
                    if(overallPercentage > 0.949){
                        var overallColor = '#12B987';
                    }else if((overallPercentage < 0.949) && (overallPercentage > 0.849)){
                        var overallColor = '#F39E0E';
                    }else{
                        var overallColor = '#E64A4E';
                        var PassOrFail = 'FAILED';
                    }
                // Overall Result
            }else{
                // Overall Result
                    var writtenPercent = (writtenExamScore / writtenExamTotal);
                    var overallTotal = 100;
                    var nWrittenPercent = writtenPercent * 100;
                    var overallScore = Math.round(nWrittenPercent);
                    
                    var overallPercentage = (writtenPercent);

                    var overallDifference = overallTotal - overallScore;
                    console.log(overallPercentage);
                    var PassOrFail = 'PASSED';
                    if(overallPercentage > 0.949){
                        var overallColor = '#12B987';
                    }else if((overallPercentage < 0.949) && (overallPercentage > 0.849)){
                        var overallColor = '#F39E0E';
                    }else{
                        var overallColor = '#E64A4E';
                        var PassOrFail = 'FAILED';
                    }
                // Overall Result
                
            }

            // Chart
                new Chart(
                    document.getElementById("written-chart"), {
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
                            cutout: '0'
                        }
                    }
                );

                if(billing_type == "CHARGEABLE"){
                    new Chart(
                        document.getElementById("driving-chart"), {
                            type: 'doughnut',
                            data: {
                                datasets: [{
                                    backgroundColor: [drivingExamColor, "#CDD3D6"],
                                    data: [drivingExamScore, drivingExamDifference]
                                }]
                            },
                            options: {
                                rotation: -225 * (Math.PI / 180),
                                circumference: Math.PI * 1.5,
                                responsive: true,
                                cutout: '0'
                            }
                        }
                    );
                }else{

                }
                new Chart(
                    document.getElementById("overall-result"), {
                        type: 'doughnut',
                        data: {
                            datasets: [{
                                backgroundColor: [overallColor, "#CDD3D6"],
                                data: [overallScore, overallDifference]
                            }]
                        },
                        options: {
                            rotation: -225 * (Math.PI / 180),
                            circumference: Math.PI * 1.5,
                            responsive: true,
                            cutout: '0'
                        }
                    }
                );

            // Chart


            let writtenCount = 0;
            const intervalWritten = setInterval(function() {
                writtenCount++;
                $('#writtenExamScore').html(writtenCount);
                if (writtenCount == writtenExamScore) {
                    clearInterval(intervalWritten);
                    $('.writtenOutOf').html('out of ' + writtenExamTotal);
                    $('.outOf').removeClass('opacity-0');
                    $('.outOf').addClass('opacity-100');
                }
            }, 18);

            let drivingCount = 0;
            const intervalDriving = setInterval(function() {
                drivingCount++;
                $('#drivingExamScore').html(drivingCount);
                if (drivingCount == drivingExamScore) {
                    clearInterval(intervalDriving);
                    $('.outOf').removeClass('opacity-0');
                    $('.outOf').addClass('opacity-100');
                }
            }, 5);

            let overallCount = 0;
            const intervalOverall = setInterval(function() {
                overallCount++;
                $('#overallResult').html(overallCount);
                
                if (overallCount == (overallScore)) {
                    clearInterval(intervalOverall);
                    $('.outOf').removeClass('opacity-0');
                    $('.outOf').addClass('opacity-100');
                }
            }, 5);

            $('.PassOrFail').html(PassOrFail);
        });
    </script>
@endsection
