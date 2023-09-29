@extends('layouts.app')
@section('title','CUSTOMER - ADD')
@section('content')

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="h-full max-h-full py-5 pl-5 pr-8 overflow-y-auto bg-white rounded-lg shadow-xl">
            <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <h1 class="mb-2 text-xl font-bold text-gray-600">COMPANY DETAILS</h1>
                    <div class="pl-3">
                        <div class="mb-3">
                            <label for="name" class="block text-sm font-semibold text-gray-600">Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required autocomplete="off">
                        </div>
        
                        <div class="mb-3">
                            <label for="adress" class="block text-sm font-semibold text-gray-600">Address <span class="text-red-500">*</span></label>
                            <input type="text" id="adress" name="adress" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required autocomplete="off">
                        </div>
        
                        <div class="mb-3">
                            <label for="area" class="block text-sm font-semibold text-gray-600">Area <span class="text-red-500">*</span></label>
                            <select id="area" name="area" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="CENTRAL">Central</option>
                                <option value="SOUTH LUZON">South Luzon</option>
                                <option value="NORTH LUZON">North Luzon</option>
                                <option value="NORTH">North</option>
                                <option value="SOUTH">South</option>
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
                                                <input type="text" id="cp1_name" name="cp1_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp1_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                <input type="text" id="cp1_number" name="cp1_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp1_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                <input type="text" id="cp1_email" name="cp1_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h1 class="text-gray-600">#2</h1>
                                        <div class="flex flex-col w-full pl-5 lg:flex-row gap-x-8">
                                            <div class="w-full mb-3">
                                                <label for="cp2_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                <input type="text" id="cp2_name" name="cp2_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp2_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                <input type="text" id="cp2_number" name="cp2_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp2_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                <input type="text" id="cp2_email" name="cp2_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="text-gray-600">#3</h1>
                                        <div class="flex flex-col w-full pl-5 lg:flex-row gap-x-8">
                                            <div class="w-full mb-3">
                                                <label for="cp3_name" class="block text-sm font-semibold text-gray-600">Name</label>
                                                <input type="text" id="cp3_name" name="cp3_name" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp3_number" class="block text-sm font-semibold text-gray-600">Phone Number</label>
                                                <input type="text" id="cp3_number" name="cp3_number" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                            <div class="w-full mb-3">
                                                <label for="cp3_email" class="block text-sm font-semibold text-gray-600">E-mail</label>
                                                <input type="text" id="cp3_email" name="cp3_email" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- CONTACT PERSON END --}}
                    </div>
                </div>

                <div class="flex gap-x-8">
                    <button class="w-1/2 py-2 font-bold tracking-wider text-white bg-blue-500 rounded-lg hover:scale-105">SAVE</button>
                    <a href="{{ route('customer.index') }}" class="w-1/2 py-2 font-bold tracking-wider text-center text-white bg-gray-500 rounded-lg hover:scale-105">BACK</a>
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

            $(document).on('click', '.datepicker-cell', function() {
                var enteredDate = new Date($('#event_date').val());
                var currentDate = new Date();
                if (enteredDate < currentDate) {
                    var formattedDate = moment(currentDate).format('MM/DD/YYYY');
                    $('#event_date').val(formattedDate);
                }
            });
        });
    </script>
@endsection
