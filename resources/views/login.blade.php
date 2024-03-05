@extends('layouts.app')
@section('title','LOGIN')
@section('content')
    <div class="w-screen h-screen overflow-hidden">
        <div class="flex items-center justify-center pt-5 pb-16 lg:hidden bg-gradient-to-t from-sky-800 to-sky-300">
            <img src="{{ asset('storage/images/system/login.png') }}" alt="" class="w-1/2 h-auto">
        </div>
        <div class="relative grid lg:grid-cols-2 h-full w-full z-50 rounded-l-[30px] sm:rounded-l-[50px] lg:rounded-none -top-14 lg:top-0 lg:bg-transparent">
            <div class="flex flex-col lg:justify-center items-center pt-[15vh] lg:pt-0">
                <h1 class="mb-5 text-3xl font-bold">LOGIN</h1>
                <div class="w-3/4 max-w-sm">
                    @error('error')
                        <div class="flex p-4 mb-5 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Error</span>
                            <div>
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        </div>
                    @enderror
                    <form method="POST" action="{{ route('login.auth') }}">
                        @csrf
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="id_number" id="id_number" value="{{ old('id_number') }}" class="block py-2.5 px-0 w-full text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-sky-600 peer" placeholder=" " required autocomplete="off"/>
                            <label for="id_number" class="peer-focus:font-semibold font-semibold absolute text-base text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-sky-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 tracking-wide">ID Number</label>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-sky-600 peer" placeholder=" " required />
                            <label for="password" class="peer-focus:font-semibold font-semibold absolute text-base text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-sky-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 tracking-wide">Password</label>
                        </div>
                        <div class="w-full">
                            <button id="loginButton" type="submit" class="w-full py-3 mb-3 font-bold text-white rounded-full shadow-lg bg-sky-800 hover:scale-105">Login</button>
                            <a href="{{ url('/') }}" onclick="$('#loading').toggleClass('hidden');" type="button" class="w-full py-3 font-bold text-center text-white rounded-full shadow-lg bg-neutral-800 hover:scale-105">Back</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="items-center justify-center hidden lg:flex">
                <img src="{{ asset('storage/images/system/login.png') }}" alt="" class="w-full h-auto scale-90">
            </div>
        </div>
        <div class="absolute top-0 left-0 z-10 hidden w-screen h-screen overflow-hidden lg:flex">
            <div class="absolute left-[65%] w-[150vw] h-[150vh] bg-gradient-to-t from-sky-800 to-sky-300 rounded-[100px] rotate-[30deg] z-20"></div>
            <div class="absolute left-[64%] -top-[29%] w-[150vw] h-[150vh] bg-gradient-to-t from-sky-800 to-sky-300 opacity-70 rounded-[100px] rotate-[18deg] z-10"></div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#loginButton').click(function(){
                if($('#id_number').val() != '' && $('#password').val() != ''){
                    $('#loading').toggleClass('hidden');
                }
            });
        });
    </script>
@endsection