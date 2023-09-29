@extends('layouts.app')
@section('title','SCHEDULED TRAININGS - EDIT')
@section('content')

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="h-full max-h-full py-5 pl-5 pr-8 overflow-y-auto bg-white rounded-lg shadow-xl">
            <form action="{{ route('trainings.update', ['key' => $key]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-10">
                    <h1 class="mb-2 text-xl font-bold text-gray-600">COMPANY DETAILS</h1>
                    <div class="pl-3">
                        <div class="relative flex flex-col mb-3 optionDiv">
                            <label class="block text-sm font-semibold text-gray-600">Company Name <span class="text-red-500">*</span></label>
                            <input readonly type="text" id="name" name="name" value="{{ $request->name }}" class="inputOption block w-full p-2.5 text-gray-600 border border-gray-300 rounded-lg bg-gray-50 sm:text-sm pointer-events-none" required autocomplete="off">
                            {{-- <div class="listOption hidden absolute top-[62px] w-full rounded-lg border-x border-b border-gray-300 overflow-y-auto max-h-[30vh] text-gray-600 bg-white z-[99]">
                                <ul>
                                    @foreach ($customers as $customer)
                                        <li data-id="{{ $customer->id }}" class="p-2 border-t border-gray-300 cursor-pointer first:border-0 hover:bg-gray-200">{{ $customer->name }}</li>
                                    @endforeach
                                </ul>
                            </div> --}}
                        </div>
        
                        <div class="mb-3">
                            <label for="address" class="block text-sm font-semibold text-gray-600">Address <span class="text-red-500">*</span></label>
                            <input type="text" id="address" name="address" value="{{ $request->address }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required autocomplete="off">
                        </div>
        
                        <div class="mb-3">
                            <label for="area" class="block text-sm font-semibold text-gray-600">Area <span class="text-red-500">*</span></label>
                            <select id="area" name="area" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option {{ $request->area == 'CENTRAL' ? 'selected' : '' }} value="CENTRAL">Central</option>
                                <option {{ $customer->area == 'SOUTH LUZON' ? 'selected' : '' }} value="SOUTH LUZON">South Luzon</option>
                                <option {{ $customer->area == 'NORTH LUZON' ? 'selected' : '' }} value="NORTH LUZON">North Luzon</option>
                                <option {{ $request->area == 'VISAYAS' ? 'selected' : '' }} value="VISAYAS">Visayas</option>
                                <option {{ $request->area == 'MINDANAO' ? 'selected' : '' }} value="MINDANAO">Mindanao</option>
                            </select>
                        </div>
                        {{-- CONTACT PERSON --}}
                            <div class="mb-3">
                                <h1 class="font-semibold text-gray-600">CONTACT PERSON/s</h1>
                                <div class="pl-5">
                                    <div class="mb-3">
                                        <h1 class="text-gray-600">#1</h1>
                                        <div class="flex flex-col w-full pl-5 lg:flex-row gap-x-8">
                                            <div class="w-full mb-3">
                                                <label for="cp1_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                <input type="text" id="cp1_name" name="cp1_name" value="{{ $request->cp1_name }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp1_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                <input type="text" id="cp1_number" name="cp1_number" value="{{ $request->cp1_number }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp1_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                <input type="text" id="cp1_email" name="cp1_email" value="{{ $request->cp1_email }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h1 class="text-gray-600">#2</h1>
                                        <div class="flex flex-col w-full pl-5 lg:flex-row gap-x-8">
                                            <div class="w-full mb-3">
                                                <label for="cp2_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                <input type="text" id="cp2_name" name="cp2_name" value="{{ $request->cp2_name }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp2_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                <input type="text" id="cp2_number" name="cp2_number" value="{{ $request->cp2_number }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp2_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                <input type="text" id="cp2_email" name="cp2_email" value="{{ $request->cp2_email }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="text-gray-600">#3</h1>
                                        <div class="flex flex-col w-full pl-5 lg:flex-row gap-x-8">
                                            <div class="w-full mb-3">
                                                <label for="cp3_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                <input type="text" id="cp3_name" name="cp3_name" value="{{ $request->cp3_name }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp3_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                <input type="text" id="cp3_number" name="cp3_number" value="{{ $request->cp3_number }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp3_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                <input type="text" id="cp3_email" name="cp3_email" value="{{ $request->cp3_email }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- CONTACT PERSON END --}}

                    </div>
                </div>

                <div>
                    <h1 class="mb-2 text-xl font-bold text-gray-600">OTHER DETAILS</h1>
                    <div class="pl-3">
                        <div class="mb-3">
                            <label for="category" class="block text-sm font-medium text-gray-600">Category <span class="text-red-500">*</span></label>
                            <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option {{ $request->category == 'PURCHASED' ? 'selected' : '' }} value="PURCHASED">Purchased</option>
                                <option {{ $request->category == 'RENTAL' ? 'selected' : '' }} value="RENTAL">Rental</option>
                            </select>
                        </div>

                        {{-- PM --}}
                            <div class="flex items-center mt-4 mb-3">
                                <span class="mx-3 text-sm font-semibold text-gray-600">PM</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input {{ $request->is_PM != '0' ? 'checked' : '' }} type="checkbox" id="pm" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>

                            {{-- CONTRACT DETAILS --}}
                                    <div id="contractDetailsContainer1" class="mb-0 h-0 transition-all duration-500 py-0  {{ $request->is_PM != '0' ? 'h-[136px] mb-6 pt-2' : 'overflow-hidden' }}">
                                        <div id="contractDetailsContainer" class="relative p-5 border border-gray-400 rounded-lg">
                                            <h1 class="absolute top-0 px-2 font-bold tracking-wide text-gray-500 -translate-y-1/2 bg-white left-5">Contract Details</h1>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-900" for="contract_details">Upload file</label>
                                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="file_input_help" id="contract_details" name="contract_details" type="file" accept="application/pdf">
                                                <p class="mt-1 text-sm text-gray-500" id="file_input_help">PDF (MAX. 20mb).</p>
                                            </div>
                                        </div>
                                    </div>
                            {{-- CONTRACT DETAILS END --}}
                        {{-- PM END --}}

                        <div class="mb-3">
                            <label for="brand" class="block text-sm font-semibold text-gray-600">Brand <span class="text-red-500">*</span></label>
                            <select id="brand" name="brand" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option {{ $request->brand == 'BT' ? 'selected' : '' }} value="BT">BT</option>
                                <option {{ $request->brand == 'RAYMOND' ? 'selected' : '' }} value="RAYMOND">Raymond</option>
                                <option {{ $request->brand == 'TOYOTA' ? 'selected' : '' }} value="TOYOTA">Toyota</option>
                            </select>
                        </div>

                        <div class="w-full mb-3">
                            <label for="model" class="block text-sm font-semibold text-gray-600">Model <span class="text-red-500">*</span></label>
                            <input type="text" id="model" name="model" value="{{ $request->model }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label for="unit_type" class="block text-sm font-semibold text-gray-600">Unit Type <span class="text-red-500">*</span></label>
                            <select id="unit_type" name="unit_type" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option {{ $request->unit_type == 'VNA (VERY NARROW AISLE)' ? 'selected' : '' }} value="VNA (VERY NARROW AISLE)">VNA (Very Narrow Aisle)</option>
                                <option {{ $request->unit_type == 'REACH TRUCK' ? 'selected' : '' }} value="REACH TRUCK">Reach Truck</option>
                                <option {{ $request->unit_type == 'COUNTER BALANCE - IC' ? 'selected' : '' }} value="COUNTER BALANCE - IC">Counter Balance - IC</option>
                                <option {{ $request->unit_type == 'COUNTER BALANCE - EL' ? 'selected' : '' }} value="COUNTER BALANCE - EL">Counter Balance - EL</option>
                                <option {{ $request->unit_type == 'ORDER PICKER' ? 'selected' : '' }} value="ORDER PICKER">Order Picker</option>
                                <option {{ $request->unit_type == 'STACKER' ? 'selected' : '' }} value="STACKER">Stacker</option>
                                <option {{ $request->unit_type == 'POWERED PALLET TRUCK' ? 'selected' : '' }} value="POWERED PALLET TRUCK">Powered Pallet Truck</option>
                                <option {{ $request->unit_type == 'HAND PALLET TRUCK' ? 'selected' : '' }} value="HAND PALLET TRUCK">Hand Pallet Truck</option>
                                <option {{ $request->unit_type == 'ARTICULATED' ? 'selected' : '' }} value="ARTICULATED">Articulated</option>
                                <option {{ $request->unit_type == 'SIDE LOADER' ? 'selected' : '' }} value="SIDE LOADER">Side Loader</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="no_of_unit" class="block text-sm font-semibold text-gray-600">Number of Unit/s <span class="text-red-500">*</span></label>
                            <input type="text" id="no_of_unit" name="no_of_unit" value="{{ $request->no_of_unit }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" value="1" required autocomplete="off">
                        </div>
        
                        <div class="mb-3">
                            <label for="billing_type" class="block text-sm font-semibold text-gray-600">Billing Type</label>
                            <select id="billing_type" name="billing_type" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value=""></option>
                                <option {{ $request->billing_type == 'CHARGEABLE' ? 'selected' : '' }} value="CHARGEABLE">Chargeable</option>
                                <option {{ $request->billing_type == 'NON-CHARGEABLE' ? 'selected' : '' }} value="NON-CHARGEABLE">Non-Chargeable</option>
                            </select>
                        </div>
                        <div class="w-full mb-3">
                            <label for="no_of_attendees" class="block text-sm font-semibold text-gray-600">Number of Attendees</label>
                            <input type="text" id="no_of_attendees" name="no_of_attendees" value="{{ $request->no_of_attendees }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" value="1" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="knowledge_of_participants" class="block text-sm font-semibold text-gray-600">Knowledge of Attendees</label>
                            <select id="knowledge_of_participants" name="knowledge_of_participants" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value=""></option>
                                <option {{ $request->knowledge_of_participants == 'WITH EXPERIENCE' ? 'selected' : '' }} value="WITH EXPERIENCE">With Experience</option>
                                <option {{ $request->knowledge_of_participants == 'WITHOUT EXPERIENCE' ? 'selected' : '' }} value="WITHOUT EXPERIENCE">Without Experience</option>
                            </select>
                        </div>
                        <div class="w-full mb-3">
                            <label for="venue" class="block text-sm font-semibold text-gray-600">Venue</label>
                            <input type="text" id="venue" name="venue" value="{{ $request->venue }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                        </div>
                        <div class="w-full mb-3">
                            <label for="event_date" class="block text-sm font-semibold text-gray-600">Date</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input datepicker type="text" id="event_date" name="event_date" value="{{ $request->training_date != '' ? date('m/d/Y', strtotime($request->training_date)) : '' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="trainer" class="block text-sm font-semibold text-gray-600">Trainer</label>
                            <select id="trainer" name="trainer" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value=""></option>
                                @foreach ($trainers as $trainer)
                                    <option {{ $request->trainer == $trainer->id ? 'selected' : '' }} value="{{$trainer->id}}">{{$trainer->first_name.' '.$trainer->last_name}}</span></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full mb-3">
                            <label for="remarks" class="block text-sm font-semibold text-gray-600">Remarks</label>
                            <input type="text" id="remarks" name="remarks" value="{{ $request->remarks }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="flex mt-5 gap-x-8">
                    <button class="w-1/2 py-2 font-bold tracking-wider text-white bg-blue-500 rounded-lg hover:scale-105">SAVE</button>
                    <a href="{{ route('trainings.index') }}" class="w-1/2 py-2 font-bold tracking-wider text-center text-white bg-gray-500 rounded-lg hover:scale-105">BACK</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $(document).on('click', '.datepicker-cell', function() {
                var enteredDate = new Date($('#event_date').val());
                var currentDate = new Date();
                if (enteredDate < currentDate) {
                    var formattedDate = moment(currentDate).format('MM/DD/YYYY');
                    $('#event_date').val(formattedDate);
                }
            });
            
            jQuery(document).on( "click", ".inputOption", function(e){
                $('.content').not($(this).closest('.optionDiv').find('.listOption')).addClass('hidden');
                $(this).closest('.optionDiv').find('.listOption').toggleClass('hidden');
                var value = $(this).val().toLowerCase();
                searchFilter(value);
                e.stopPropagation();
            });

            function searchFilter(searchInput){
                $(".listOption li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchInput) > -1)
                });
            }
            
            jQuery(document).on( "keydown", ".inputOption", function(e){
                var value = $(this).val().toLowerCase();
                searchFilter(value);

                if (event.keyCode === 9) {
                    $('.listOption').addClass('hidden');
                }
            });

            jQuery(document).on( "click", ".listOption li", function(){
                var name = $(this).html();
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();


                $.ajax({
                    url:"{{ route('request.getcom') }}",
                    method:"POST",
                    dataType: 'json',
                    data:{
                        id: id,
                        _token: _token
                    },
                    success:function(result){
                        $('#adress').val(result.address);
                        $('#area').val(result.area);

                        $('#cp1_name').val(result.cp1_name);
                        $('#cp1_number').val(result.cp1_number);
                        $('#cp1_email').val(result.cp1_email);

                        $('#cp2_name').val(result.cp2_name);
                        $('#cp2_number').val(result.cp2_number);
                        $('#cp2_email').val(result.cp2_email);

                        $('#cp3_name').val(result.cp3_name);
                        $('#cp3_number').val(result.cp3_number);
                        $('#cp3_email').val(result.cp3_email);

                        $(".listOption li").closest('.optionDiv').find('input').val(name);
                        $('.listOption').addClass('hidden');
                    }
                })

            });

            $(document).click(function() {
                $('.listOption').addClass('hidden');
            });

            $('#pm').change(function() {
                if ($(this).is(':checked')) {
                    $('#contractDetailsContainer1').toggleClass('h-[136px]');
                    $('#contractDetailsContainer1').toggleClass('mb-6');
                    $('#contractDetailsContainer1').toggleClass('pt-2');
                    setTimeout(function() {
                        $('#contractDetailsContainer1').toggleClass('overflow-hidden');
                    }, 450);
                } else {
                    $('#contractDetailsContainer1').toggleClass('h-[136px]');
                    $('#contractDetailsContainer1').toggleClass('mb-6');
                    $('#contractDetailsContainer1').toggleClass('pt-2');
                    $('#contractDetailsContainer1').toggleClass('overflow-hidden');
                }
            });
        });
    </script>
@endsection
