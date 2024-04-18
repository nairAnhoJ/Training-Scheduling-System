@extends('layouts.app')
@section('title','WRITTEN EXAM')
@section('content')

    <div class="w-full p-5 bg-gray-200">
        <div class="min-h-[calc(100vh-96px)] p-3 bg-white rounded-lg shadow-xl">
            <div class="p-4 overflow-hidden rounded-lg">
                <form method="POST" action="{{ route('attendees.store') . '?key=' . $key }}">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-1">
                        <div>
                            {{ $attendee->name }}
                        </div>
                        <div>
                            {{ $attendee->name }}
                        </div>
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
