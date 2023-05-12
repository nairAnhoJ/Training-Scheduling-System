@extends('layouts.app')
@section('content')
    <div class="h-screen w-screen overflow-hidden">
        <div class="relative grid grid-cols-2 h-full w-full z-50">
            <div class="flex justify-center items-center">
                LOGIN
            </div>
            <div class="flex justify-center items-center">
                <img src="{{ asset('storage/images/system/login.png') }}" alt="" class="w-full h-auto scale-90">
            </div>
        </div>
        <div class="absolute top-0 left-0 w-screen h-screen overflow-hidden z-10">
            <div class="absolute left-[65%] w-[150vw] h-[150vh] bg-gradient-to-t from-sky-800 to-sky-300 rounded-[100px] rotate-[30deg] z-20"></div>
            <div class="absolute left-[64%] -top-[29%] w-[150vw] h-[150vh] bg-gradient-to-t from-sky-800 to-sky-300 opacity-70 rounded-[100px] rotate-[18deg] z-10"></div>
        </div>
    </div>
@endsection