@extends('layouts.app')
@section('title','CHANGE PASSWORD')
@section('content')
    <div class="h-screen w-screen overflow-hidden">
        <nav class="absolute w-screen top-0 left-0 z-[99] bg-blue-500 h-14">
            <div class="flex flex-row-reverse h-full">
                <form method="POST" action="{{ route('logout') }}" class="w-36 h-full p-2.5">
                    @csrf
                    <input type="submit" value="LOG OUT" class="bg-white text-blue-600 w-full h-full rounded-xl hover:scale-105 shadow-lg font-black tracking-wider flex justify-center items-center cursor-pointer">
                </form>
            </div>
        </nav>
        <div class="justify-center items-center lg:hidden flex bg-gradient-to-t from-sky-800 to-sky-300 pt-5 pb-16">
            <img src="{{ asset('storage/images/system/login.png') }}" alt="" class="w-1/2 h-auto">
        </div>
        <div class="relative grid lg:grid-cols-2 h-full w-full z-50 rounded-l-[30px] sm:rounded-l-[50px] lg:rounded-none -top-14 lg:top-0 bg-white lg:bg-transparent">
            <div class="flex flex-col lg:justify-center items-center pt-[15vh] lg:pt-0">
                <h1 class="mb-5 text-3xl font-bold">CHANGE PASSWORD</h1>
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
                    <form method="POST" action="{{ route('password.changeConfirm') }}">
                        @csrf
                        <div class="w-full border-l-8 border-blue-600 p-4 bg-blue-200 mb-4">
                            <h1 class="text-sm">You are required to change your password before you login for the first time.</h1>
                            <p class="mt-3 text-sm">Note: Password must be at least <span class="text-pink-600 font-semibold text-base">8</span> characters.</p>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-sky-600 peer" placeholder=" " required />
                            <label for="password" class="peer-focus:font-semibold font-semibold absolute text-base text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-sky-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 tracking-wide">Password</label>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="block py-2.5 px-0 w-full text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-sky-600 peer" placeholder=" " required />
                            <label for="password_confirmation" class="peer-focus:font-semibold font-semibold absolute text-base text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-sky-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 tracking-wide">Confirm Password</label>
                        </div>
                        <div class="w-full">
                            <button type="submit" class="w-full py-3 mb-3 rounded-full bg-sky-700 text-white font-bold shadow-lg hover:scale-105">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="justify-center items-center lg:flex hidden">
                <img src="{{ asset('storage/images/system/login.png') }}" alt="" class="w-full h-auto scale-90">
            </div>
        </div>
        <div class="absolute top-0 left-0 w-screen h-screen overflow-hidden z-10 lg:flex hidden">
            <div class="absolute left-[65%] w-[150vw] h-[150vh] bg-gradient-to-t from-sky-800 to-sky-300 rounded-[100px] rotate-[30deg] z-20"></div>
            <div class="absolute left-[64%] -top-[29%] w-[150vw] h-[150vh] bg-gradient-to-t from-sky-800 to-sky-300 opacity-70 rounded-[100px] rotate-[18deg] z-10"></div>
        </div>
    </div>
@endsection