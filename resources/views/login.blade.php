@extends('layouts.app')
@section('content')
    <div class="h-screen w-screen overflow-hidden">
        <div class="justify-center items-center lg:hidden flex bg-gradient-to-t from-sky-800 to-sky-300 pt-5 pb-16">
            <img src="{{ asset('storage/images/system/login.png') }}" alt="" class="w-1/2 h-auto">
        </div>
        <div class="relative grid lg:grid-cols-2 h-full w-full z-50 rounded-l-[30px] sm:rounded-l-[50px] lg:rounded-none -top-14 lg:top-0 bg-white lg:bg-transparent">
            <div class="flex flex-col lg:justify-center items-center pt-[15vh] lg:pt-0">
                <h1 class="mb-5 text-3xl font-bold">LOGIN</h1>
                <div class="w-3/4 max-w-sm">
                    <form action="">
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="id_number" id="id_number" class="block py-2.5 px-0 w-full text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-sky-600 peer" placeholder=" " required />
                            <label for="id_number" class="peer-focus:font-semibold font-semibold absolute text-base text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-sky-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 tracking-wide">ID Number</label>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-sky-600 peer" placeholder=" " required />
                            <label for="password" class="peer-focus:font-semibold font-semibold absolute text-base text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-sky-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 tracking-wide">Password</label>
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