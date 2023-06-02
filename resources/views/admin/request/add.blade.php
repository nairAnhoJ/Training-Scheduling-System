@extends('layouts.app')
@section('title','REQUESTS - ADD')
@section('content')

    {{-- VIEW EVENT MODAL --}}
        <!-- Modal toggle -->
        <button data-modal-target="viewEventModal" data-modal-toggle="viewEventModal" id="viewEventButton" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
            Toggle modal
        </button>
        
        <!-- Main modal -->
        <div id="viewEventModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 pt-8 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-3xl h-full bg-white rounded-lg overflow-x-hidden overflow-y-auto">
                <!-- Modal content -->
                <div class="relative shadow text-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t bg-blue-500">
                        <h3 id="viewCompanyName" class="text-xl tracking-wide font-semibold text-gray-900 flex items-center"></h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="viewEventModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 overflow-y-auto overflow-x-hidden h-[calc(100vh-220px)]">
                        <div class="">
                            <div class="grid grid-cols-5">
                                <div>Date: </div>
                                <div id="viewDate" class="col-span-4 font-semibold text-lg">DATE NGAYON (M d, YYYY)</div>

                                <div>Venue: </div>
                                <div id="viewDate" class="col-span-4 font-semibold text-lg">BRGY. SAKSAKAN, MAKAILAG, SWERTE</div>
                            </div>

                            <div class="mt-5">
                                <div class="flex items-center">
                                    <h1 class="text-xl mr-3 whitespace-nowrap text-gray-700 font-bold tracking-wider">CUSTOMER DETAILS</h1><hr class="w-full whitespace-nowrap border-gray-500">
                                </div>
                                <div class="grid grid-cols-5">
                                    <div>Address: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">BRGY. SAKSAKAN, MAKAILAG, SWERTE</div>

                                    <h3 class="font-semibold col-span-5">Contact Person/s:</h3>
                                    <div class="ml-10">Name: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">JUAN DELA CRUZ</div>
                                    <div class="ml-10">Date: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">09123456789</div>
                                    <div class="ml-10">E-mail: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">juan.delacruz@email.com <br>*note: Kung tatlo po ang contact person tatlo rin po ang lalabas dito.</div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <div class="flex items-center">
                                    <h1 class="text-xl mr-3 whitespace-nowrap text-gray-700 font-bold tracking-wider">OTHER DETAILS</h1><hr class="w-full whitespace-nowrap border-gray-500">
                                </div>
                                <div class="grid grid-cols-5">
                                    <div>Area: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">NORTH</div>
                                    <div>Billing Type: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">CHARGEABLE</div>
                                    <div>Type: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">RENTAL UNIT</div>
                                    <div>Pax: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">13</div>
                                    <div>Trainer: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">CARDO DALISAY</div>
                                    <div>Status: </div>
                                    <div id="viewDate" class="col-span-4 font-semibold text-lg">Scheduled</div>
                                    <div>Notes: </div>
                                    <div class="col-span-4 font-semibold">
                                        <textarea id="viewNotes" class="w-full border-0 ring-0 focus:ring-0 p-0 text-lg resize-none cursor-default" readonly>DITO YUNG MGA REMARKS  NG EVENT OR KAHIT ANO NA GUSTONG ILAGAY NI COORDINATOR, PWEDE RIN ITONG BLANGKO</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        {{-- <button data-modal-hide="viewEventModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">I accept</button> --}}
                        <button data-modal-hide="viewEventModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-black tracking-wide px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- VIEW EVENT MODAL END --}}

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="bg-white shadow-xl rounded-lg py-5 pl-5 pr-8 h-full max-h-full overflow-y-auto">
            <form action="{{ route('request.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-10">
                    <h1 class="text-gray-600 font-bold text-xl mb-2">COMPANY DETAILS</h1>
                    <div class="pl-3">
                        <div class="flex flex-col relative optionDiv mb-3">
                            <label for="name" class="block text-sm font-semibold text-gray-600">Company Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" class="inputOption block w-full p-2.5 text-gray-600 border border-gray-300 rounded-lg bg-gray-50 sm:text-sm" required autocomplete="off">
                            <div class="listOption hidden absolute top-[62px] w-full rounded-lg border-x border-b border-gray-300 overflow-y-auto max-h-[30vh] text-gray-600 bg-white z-[99]">
                                <ul>
                                    @foreach ($customers as $customer)
                                        <li data-id="{{ $customer->id }}" class="p-2 first:border-0 border-t border-gray-300 hover:bg-gray-200 cursor-pointer">{{ $customer->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
        
                        <div class="mb-3">
                            <label for="adress" class="block text-sm font-semibold text-gray-600">Address <span class="text-red-500">*</span></label>
                            <input type="text" id="adress" name="adress" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required>
                        </div>
        
                        <div class="mb-3">
                            <label for="area" class="block text-sm font-semibold text-gray-600">Area <span class="text-red-500">*</span></label>
                            <select id="area" name="area" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="CENTRAL">Central</option>
                                <option value="NORTH">North</option>
                                <option value="SOUTH">South</option>
                            </select>
                        </div>
                        {{-- CONTACT PERSON --}}
                            <div class="mb-3">
                                <h1 class="text-gray-600 font-semibold">CONTACT PERSON/s</h1>
                                <div class="pl-5">
                                    <div class="mb-3">
                                        <h1 class="text-gray-600">#1</h1>
                                        <div class="pl-5 flex flex-col lg:flex-row gap-x-8 w-full">
                                            <div class="mb-3 w-full">
                                                <label for="cp1_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                <input type="text" id="cp1_name" name="cp1_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                            </div>
                                            <div class="mb-3 w-full">
                                                <label for="cp1_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                <input type="text" id="cp1_number" name="cp1_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                            </div>
                                            <div class="mb-3 w-full">
                                                <label for="cp1_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                <input type="text" id="cp1_email" name="cp1_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h1 class="text-gray-600">#2</h1>
                                        <div class="pl-5 flex flex-col lg:flex-row gap-x-8 w-full">
                                            <div class="mb-3 w-full">
                                                <label for="cp2_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                <input type="text" id="cp2_name" name="cp2_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                            </div>
                                            <div class="mb-3 w-full">
                                                <label for="cp2_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                <input type="text" id="cp2_number" name="cp2_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                            </div>
                                            <div class="mb-3 w-full">
                                                <label for="cp2_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                <input type="text" id="cp2_email" name="cp2_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="text-gray-600">#3</h1>
                                        <div class="pl-5 flex flex-col lg:flex-row gap-x-8 w-full">
                                            <div class="mb-3 w-full">
                                                <label for="cp3_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                <input type="text" id="cp3_name" name="cp3_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                            </div>
                                            <div class="mb-3 w-full">
                                                <label for="cp3_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                <input type="text" id="cp3_number" name="cp3_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                            </div>
                                            <div class="mb-3 w-full">
                                                <label for="cp3_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                <input type="text" id="cp3_email" name="cp3_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- CONTACT PERSON END --}}

                    </div>
                </div>

                <div>
                    <h1 class="text-gray-600 font-bold text-xl mb-2">OTHER DETAILS</h1>
                    <div class="pl-3">
                        <div class="mb-3">
                            <label for="category" class="block text-sm font-medium text-gray-600">Category <span class="text-red-500">*</span></label>
                            <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="PURCHASED">Purchased</option>
                                <option value="RENTAL">Rental</option>
                            </select>
                        </div>

                        {{-- PM --}}
                            <div class="mb-3 mt-4 flex items-center">
                                <span class="mx-3 text-sm font-semibold text-gray-600">PM</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="pm" value="" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>

                            {{-- CONTRACT DETAILS --}}
                                    <div id="contractDetailsContainer1" class="mb-0 h-0 overflow-hidden transition-all duration-500 py-0">
                                        <div id="contractDetailsContainer" class="border border-gray-400 rounded-lg p-5 relative opacity-50">
                                            <h1 class="font-bold text-gray-500 tracking-wide absolute top-0 -translate-y-1/2 left-5 bg-white px-2">Contract Details</h1>
                                            
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-900" for="contract_details">Upload file</label>
                                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="file_input_help" id="contract_details" name="contract_details" type="file">
                                                <p class="mt-1 text-sm text-gray-500" id="file_input_help">PDF (MAX. 20mb).</p>
                                            </div>


                                            {{-- <div>
                                                <div class="mb-3 w-full">
                                                    <label for="f1" class="block text-sm font-semibold text-gray-600">F1</label>
                                                    <input disabled type="text" id="f1" name="f1" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                                </div>
                                                
                                                <div class="mb-3 w-full">
                                                    <label for="f2" class="block text-sm font-semibold text-gray-600">F2</label>
                                                    <input disabled type="text" id="f2" name="f2" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                                </div>
                                                
                                                <div class="mb-3 w-full">
                                                    <label for="f3" class="block text-sm font-semibold text-gray-600">F3</label>
                                                    <input disabled type="text" id="f3" name="f3" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                                </div>
                                                
                                                <div class="mb-3 w-full">
                                                    <label for="f4" class="block text-sm font-semibold text-gray-600">F4</label>
                                                    <input disabled type="text" id="f4" name="f4" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                                </div>
                                                
                                                <div class="mb-3 w-full">
                                                    <label for="f5" class="block text-sm font-semibold text-gray-600">F5</label>
                                                    <input disabled type="text" id="f5" name="f5" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                            {{-- CONTRACT DETAILS END --}}
                        {{-- PM END --}}

                        <div class="mb-3">
                            <label for="brand" class="block text-sm font-semibold text-gray-600">Brand <span class="text-red-500">*</span></label>
                            <select id="brand" name="brand" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="BT">BT</option>
                                <option value="RAYMOND">Raymond</option>
                                <option value="TOYOTA">Toyota</option>
                            </select>
                        </div>

                        <div class="mb-3 w-full">
                            <label for="model" class="block text-sm font-semibold text-gray-600">Model <span class="text-red-500">*</span></label>
                            <input type="text" id="model" name="model" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required>
                        </div>

                        <div class="mb-3">
                            <label for="unit_type" class="block text-sm font-semibold text-gray-600">Unit Type <span class="text-red-500">*</span></label>
                            <select id="unit_type" name="unit_type" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="RENTAL">Reach Truck</option>
                                <option value="PURCHASED">Purchased</option>
                                <option value="PM">PM Contact</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="no_of_unit" class="block text-sm font-semibold text-gray-600">Number of Unit/s <span class="text-red-500">*</span></label>
                            <input type="text" id="no_of_unit" name="no_of_unit" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" value="1" required>
                        </div>
        
                        <div class="mb-3">
                            <label for="billing_type" class="block text-sm font-semibold text-gray-600">Billing Type</label>
                            <select id="billing_type" name="billing_type" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="CHARGEABLE">Chargeable</option>
                                <option value="NON-CHARGEABLE">Non-Chargeable</option>
                            </select>
                        </div>
                        <div class="mb-3 w-full">
                            <label for="no_of_attendees" class="block text-sm font-semibold text-gray-600">Number of Attendees</label>
                            <input type="text" id="no_of_attendees" name="no_of_attendees" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" value="1">
                        </div>
                        <div class="mb-3">
                            <label for="billing_type" class="block text-sm font-semibold text-gray-600">Knowledge of Attendees</label>
                            <select id="billing_type" name="billing_type" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="WITH EXPERIENCE">With Experience</option>
                                <option value="WITHOUT EXPERIENCE">Without Experience</option>
                            </select>
                        </div>
                        <div class="mb-3 w-full">
                            <label for="venue" class="block text-sm font-semibold text-gray-600">Venue</label>
                            <input type="text" id="venue" name="venue" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5">
                        </div>
                        <div class="mb-3 w-full">
                            <label for="event_date" class="block text-sm font-semibold text-gray-600">Date</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input datepicker type="text" name="event_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 flex gap-x-8">
                    <button class="bg-blue-500 w-1/2 py-2 rounded-lg text-white font-bold tracking-wider hover:scale-105">SAVE</button>
                    <a href="{{ route('request.index') }}" class="bg-gray-500 w-1/2 py-2 rounded-lg text-white font-bold tracking-wider hover:scale-105 text-center">BACK</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            
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
                    $('#contractDetailsContainer').toggleClass('opacity-50');
                    $('#f1').prop('disabled', false);
                    $('#f2').prop('disabled', false);
                    $('#f3').prop('disabled', false);
                    $('#f4').prop('disabled', false);
                    $('#f5').prop('disabled', false);
                    $('#contractDetailsContainer1').toggleClass('h-[136px]');
                    $('#contractDetailsContainer1').toggleClass('mb-6');
                    $('#contractDetailsContainer1').toggleClass('pt-2');
                    setTimeout(function() {
                        $('#contractDetailsContainer1').toggleClass('overflow-hidden');
                    }, 450);
                } else {
                    $('#contractDetailsContainer').toggleClass('opacity-50');
                    $('#f1').prop('disabled', true);
                    $('#f2').prop('disabled', true);
                    $('#f3').prop('disabled', true);
                    $('#f4').prop('disabled', true);
                    $('#f5').prop('disabled', true);
                    $('#contractDetailsContainer1').toggleClass('h-[136px]');
                    $('#contractDetailsContainer1').toggleClass('mb-6');
                    $('#contractDetailsContainer1').toggleClass('pt-2');
                    $('#contractDetailsContainer1').toggleClass('overflow-hidden');
                }
            });
        });
    </script>
@endsection
