<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Training Request</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet"> --}}
        {{-- <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Flow+Rounded&family=Varela+Round&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/flowbite.css')}}">

        <!-- Script -->
            <script src="{{asset('assets/js/jquery.js')}}"></script>
            <script src="{{asset('assets/js/tailwindcss.js')}}"></script>
            <script src="{{asset('assets/js/flowbite.js')}}"></script>
            <script src="{{asset('assets/js/fullcalendar.js')}}"></script>
        <!-- Script -->

        <!-- Styles -->
            <style>
                *{
                    /* font-family: 'Varela Round', sans-serif; */
                    /* font-family: 'Comic Neue', cursive; */
                    font-family: 'Varela Round', sans-serif;
                }

                ::-webkit-scrollbar {
                    width: 10px;
                    height: 10px;
                }
            
                ::-webkit-scrollbar-track {
                    box-shadow: inset 0 0 2px grey; 
                    border-radius: 10px;
                }
                
                ::-webkit-scrollbar-thumb {
                    background: #4B5563; 
                    border-radius: 10px;
                }
            
                ::-webkit-scrollbar-thumb:hover {
                    background: rgb(95, 95, 110);
                }
            </style>
        <!-- Styles -->
    </head>
    <body>

        <div id="submit-loading" class="hidden w-screen h-screen flex flex-col items-center justify-center bg-neutral-700 bg-opacity-60 fixed">
            <div class="w-[300px] md:w-[600px] relative mr-[80px] md:mr-[170px]">
                <img src="{{ asset('storage/images/system/Forklift-no-bg.png') }}" alt="" class="w-full">
                <img id="front_wheel" src="{{ asset('storage/images/system/Front_Wheel.png') }}" alt="" class="absolute left-[102.5px] bottom-[2.5px] w-[48.5px] md:left-[205px] md:bottom-[5px] md:w-[97px] animate-spin-counter">
                <img id="rear_wheel" src="{{ asset('storage/images/system/Rear_Wheel.png') }}" alt="" class="absolute right-[23px] bottom-[2.5px] w-[38px] md:right-[46px] md:bottom-[5px] md:w-[76px] animate-spin-counter">
            </div> 
            <h1 class="font-bold text-2xl text-white tracking-widest">LOADING</h1>
        </div>

        @if(session('success'))
            <div class="w-screen h-screen flex flex-col items-center justify-center fixed">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="text-emerald-500 w-32 pt-28">
                    <path xmlns="http://www.w3.org/2000/svg" d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                </svg>
                <p class="text-xl font-semi-bold text-center pb-28">Your request has been submitted successfully!</p>

                <a href="{{ route('TrainingRequestFromCustomer') }}" class="border px-5 py-2 rounded bg-blue-500 text-white font-semibold tracking-wider">SUBMIT ANOTHER REQUEST</a>
            </div>
        @else
            <form method="POST" action="{{ route('TrainingRequestFromCustomer.Submit') }}" class="w-screen h-screen overflow-y-auto overflow-x-hidden flex flex-col items-center bg-neutral-200 p-5 gap-y-5">
                @csrf
                {{-- HEADER --}}
                    <header class="w-full xl:px-44 2xl:px-96 flex">
                        <div class="bg-white w-full rounded-lg shadow flex flex-col md:flex-row items-center border-0">
                            <img src="{{ asset('storage/images/system/logo.png') }}" alt="" class="w-1/2 md:w-1/6 my-3 md:mx-3 min-w-[120px]">
                            <div class="w-full h-3 md:w-3 md:h-full border border-red-500 bg-red-500"></div>
                            <div class="flex flex-col items-center md:items-end w-full text-red-500 px-5 py-10">
                                <span class="font-bold text-xl md:text-5xl">FORKLIFT SAFETY AND</span>
                                <span class="font-bold text-xl md:text-5xl">OPERATION TRAINING</span>
                                <div class="text-left md:text-right w-full mt-2">
                                    <p class="font-bold">INQUIRE NOW</p>
                                    <p class="text-xs">TEL: (02) 8424-0730 LOCAL 212</p>
                                    <p class="text-xs">MOBILE: 0939 906 9616</p>
                                    <p class="text-xs">EMAIL: TRAINING08@TOYOTAFORKLIFTS-PHILIPPINES.COM</p>
                                </div>
                            </div>
                        </div>
                    </header>
                {{-- HEADER --}}

                {{-- PRIVACY POLICY --}}
                    <div class="w-full xl:px-44 2xl:px-96 flex">
                        <div class="bg-white w-full rounded-lg shadow border-0">
                            <div class="w-full bg-red-500 rounded-t-lg px-5 py-3 text-white font-bold text-xl tracking-wide">
                                Privacy Policy
                            </div>
                            <div class="p-5">
                                <div class="max-h-96 overflow-y-auto overflow-x-hidden mb-3 border p-3 rounded-lg text-sm shadow-inner text-gray-700">
                                    <p class="mb-5">
                                        As a provider of services that require the processing of personal data, we are committed to ensuring that all personal information is handled in accordance with the Data Privacy Act of 2012 in the Philippines. This law aims to protect the fundamental human right of privacy and ensure that personal data is processed and used only for legitimate purposes.
                                    </p>
            
                                    <p class="mb-5">
                                        To comply with this law, we need your consent to share your personal information with third-party entities who require access to your data to provide our services. This includes, but is not limited to, our service providers, business partners, and affiliates.
                                    </p>
            
                                    <p class="mb-5">
                                        By agreeing to this statement, you acknowledge that you have read and understood our privacy policy and agree to the processing of your personal information as described therein. You consent to the sharing of your personal information with third-party entities that we work with, but only for legitimate purposes related to the provision of our services.
                                    </p>
            
                                    <p>
                                        You have the right to withdraw your consent at any time by contacting us directly. Please note that the withdrawal of your consent may affect our ability to provide you with our services.
                                    </p>
                                </div>
            
                                <div class="w-full text-gray-700">
                                    <div class="w-full flex gap-x-2 items-center">
                                        <input {{ (old('policy') == 1) ? 'checked' : '' }} type="checkbox" name="policy" id="policy" value="1" class="border-neutral-500 rounded">
                                        <label for="policy" class="font-semibold">I Accept</label>
                                    </div>
                                    {{-- <div class="w-full flex gap-x-2 items-center">
                                        <input type="radio" name="policy" id="policy2" value="0">
                                        <label for="policy2">I do not consent</label>
                                    </div> --}}
                                </div>
                                @error('policy')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                {{-- PRIVACY POLICY --}}

                {{-- COMPANY DETAILS --}}
                    <div class="w-full xl:px-44 2xl:px-96 flex">
                        <div class="bg-white w-full rounded-lg shadow border-0">
                            <div class="w-full bg-red-500 rounded-t-lg px-5 py-3 text-white font-bold text-xl tracking-wide">
                                Company Details
                            </div>
                            <div class="p-5">
                                <div class="w-full mb-5">
                                    <label for="name" class="block text-sm font-semibold text-gray-600">Company Name <span class="text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                    @error('name')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full mb-3">
                                    <label for="address" class="block text-sm font-semibold text-gray-600">Company Address <span class="text-red-500">*</span></label>
                                    <input type="text" id="address" name="address" value="{{ old('address') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                    @error('address')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- COMPANY DETAILS --}}

                {{-- CONTACT PERSON/S --}}
                    <div class="w-full xl:px-44 2xl:px-96 flex">
                        <div class="bg-white w-full rounded-lg shadow border-0">
                            <div class="w-full bg-red-500 rounded-t-lg px-5 py-3 text-white font-bold text-xl tracking-wide">
                                Contact Person/s
                            </div>
                            <div class="p-5">
                                <div class="">
                                    <h1 class="text-gray-600 font-bold">#1</h1>
                                    <div class="w-full mb-3">
                                        <label for="cp1_name" class="block text-sm font-semibold text-gray-600">Name <span class="text-red-500">*</span></label>
                                        <input type="text" id="cp1_name" name="cp1_name" value="{{ old('cp1_name') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                        @error('cp1_name')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-full mb-3">
                                        <label for="cp1_number" class="block text-sm font-semibold text-gray-600">Phone Number <span class="text-red-500">*</span></label>
                                        <input type="text" id="cp1_number" name="cp1_number" value="{{ old('cp1_number') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                        @error('cp1_number')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-full mb-3">
                                        <label for="cp1_email" class="block text-sm font-semibold text-gray-600">E-mail <span class="text-red-500">*</span></label>
                                        <input type="text" id="cp1_email" name="cp1_email" value="{{ old('cp1_email') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                        @error('cp1_email')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <hr class="my-5 w-full md:w-1/2">
                                <div class="">
                                    <h1 class="text-gray-600 font-bold">#2</h1>
                                    <div class="w-full mb-3">
                                        <label for="cp2_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                        <input type="text" id="cp2_name" name="cp2_name" value="{{ old('cp2_name') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    </div>
                                    <div class="w-full mb-3">
                                        <label for="cp2_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                        <input type="text" id="cp2_number" name="cp2_number" value="{{ old('cp2_number') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    </div>
                                    <div class="w-full mb-3">
                                        <label for="cp2_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                        <input type="text" id="cp2_email" name="cp2_email" value="{{ old('cp2_email') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    </div>
                                </div>
                                <hr class="my-5 w-full md:w-1/2">
                                <div class="">
                                    <h1 class="text-gray-600 font-bold">#3</h1>
                                    <div class="w-full mb-3">
                                        <label for="cp3_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                        <input type="text" id="cp3_name" name="cp3_name" value="{{ old('cp3_name') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    </div>
                                    <div class="w-full mb-3">
                                        <label for="cp3_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                        <input type="text" id="cp3_number" name="cp3_number" value="{{ old('cp3_number') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    </div>
                                    <div class="w-full mb-3">
                                        <label for="cp3_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                        <input type="text" id="cp3_email" name="cp3_email" value="{{ old('cp3_email') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- CONTACT PERSON/S --}}

                {{-- OTHER DETAILS --}}
                    <div class="w-full xl:px-44 2xl:px-96 flex">
                        <div class="bg-white w-full rounded-lg shadow border-0">
                            <div class="w-full bg-red-500 rounded-t-lg px-5 py-3 text-white font-bold text-xl tracking-wide">
                                Other Details
                            </div>
                            <div class="p-5">
                                <div class="mb-3">
                                    <label for="category" class="block text-sm font-semibold text-gray-600">What type of transaction? <span class="text-red-500">*</span></label>
                                    <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:w-1/2 max-w-96 pt-2.5 pb-2 px-2">
                                        <option {{ (old('category') == 'PURCHASED') ? 'selected' : '' }} value="PURCHASED">Purchased</option>
                                        <option {{ (old('category') == 'RENTAL') ? 'selected' : '' }} value="RENTAL">Rental</option>
                                    </select>
                                    @error('category')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full mb-3">
                                    <label for="sales_representative" class="block text-sm font-semibold text-gray-600">Sales Representative <span class="text-red-500">*</span></label>
                                    <input type="text" id="sales_representative" name="sales_representative" value="{{ old('sales_representative') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    @error('sales_representative')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="brand" class="block text-sm font-semibold text-gray-600">Brand <span class="text-red-500">*</span></label>
                                    <select id="brand" name="brand" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:w-1/2 max-w-96 pt-2.5 pb-2 px-2">
                                        <option {{ (old('brand') == 'BT') ? 'selected' : '' }} value="BT">BT</option>
                                        <option {{ (old('brand') == 'TOYOTA') ? 'selected' : '' }} value="TOYOTA">Toyota</option>
                                        <option {{ (old('brand') == 'RAYMOND') ? 'selected' : '' }} value="RAYMOND">Raymond</option>
                                    </select>
                                    @error('brand')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full mb-3">
                                    <label for="model" class="block text-sm font-semibold text-gray-600">Model <span class="text-red-500">*</span></label>
                                    <input type="text" id="model" name="model" value="{{ old('model') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    @error('model')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full mb-3">
                                    <label for="serial_number" class="block text-sm font-semibold text-gray-600">Serial Number <span class="text-red-500">*</span></label>
                                    <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    @error('serial_number')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="unit_type" class="block text-sm font-semibold text-gray-600">Type of unit <span class="text-red-500">*</span></label>
                                    <select id="unit_type" name="unit_type" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:w-1/2 max-w-96 pt-2.5 pb-2 px-2">
                                        <option {{ (old('unit_type') == 'VNA (VERY NARROW AISLE)') ? 'selected' : '' }} value="VNA (VERY NARROW AISLE)">VNA (Very Narrow Aisle)</option>
                                        <option {{ (old('unit_type') == 'REACH TRUCK') ? 'selected' : '' }} value="REACH TRUCK">Reach Truck</option>
                                        <option {{ (old('unit_type') == 'COUNTER BALANCE - IC') ? 'selected' : '' }} value="COUNTER BALANCE - IC">Counter Balance - IC</option>
                                        <option {{ (old('unit_type') == 'COUNTER BALANCE - EL') ? 'selected' : '' }} value="COUNTER BALANCE - EL">Counter Balance - EL</option>
                                        <option {{ (old('unit_type') == 'ORDER PICKER') ? 'selected' : '' }} value="ORDER PICKER">Order Picker</option>
                                        <option {{ (old('unit_type') == 'STACKER') ? 'selected' : '' }} value="STACKER">Stacker</option>
                                        <option {{ (old('unit_type') == 'POWERED PALLET TRUCK') ? 'selected' : '' }} value="POWERED PALLET TRUCK">Powered Pallet Truck</option>
                                        <option {{ (old('unit_type') == 'HAND PALLET TRUCK') ? 'selected' : '' }} value="HAND PALLET TRUCK">Hand Pallet Truck</option>
                                        <option {{ (old('unit_type') == 'ARTICULATED') ? 'selected' : '' }} value="ARTICULATED">Articulated</option>
                                        <option {{ (old('unit_type') == 'SIDE LOADER') ? 'selected' : '' }} value="SIDE LOADER">Side Loader</option>
                                    </select>
                                    @error('unit_type')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full mb-3">
                                    <label for="no_of_unit" class="block text-sm font-semibold text-gray-600">Quantity of Unit/s <span class="text-red-500">*</span></label>
                                    <input type="text" id="no_of_unit" name="no_of_unit" value="{{ old('no_of_unit') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    @error('no_of_unit')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full mb-5">
                                    <label for="no_of_attendees" class="block text-sm font-semibold text-gray-600">Number of Attendees <span class="text-red-500">*</span></label>
                                    <input type="text" id="no_of_attendees" name="no_of_attendees" value="{{ old('no_of_attendees') }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full md:w-1/2 p-2.5" autocomplete="off">
                                    @error('no_of_attendees')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="knowledge_of_participants" class="block text-sm font-semibold text-gray-600">Knowledge of Attendees <span class="text-red-500">*</span></label>
                                    <select id="knowledge_of_participants" name="knowledge_of_participants" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:w-1/2 max-w-96 pt-2.5 pb-2 px-2">
                                        <option {{ (old('knowledge_of_participants') == 'WITH EXPERIENCE') ? 'selected' : '' }} value="WITH EXPERIENCE">With Experience</option>
                                        <option {{ (old('knowledge_of_participants') == 'WITHOUT EXPERIENCE') ? 'selected' : '' }} value="WITHOUT EXPERIENCE">Without Experience</option>
                                    </select>
                                    @error('knowledge_of_participants')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- OTHER DETAILS --}}

                {{-- SUBMIT BUTTON --}}
                    <div class="w-full xl:px-44 2xl:px-96 flex justify-start">
                        <button id="submitButton" class="w-40 py-3 font-bold tracking-wider text-white bg-red-500 rounded-lg hover:scale-105">SUBMIT</button>
                    </div>
                {{-- SUBMIT BUTTON --}}
            </form>
        @endif

        <script>
            $(document).ready(function(){
                $('#submitButton').click(function(){
                    $('#submit-loading').removeClass('hidden');
                });
            });
        </script>
    </body>
</html>
