@extends('layouts.app')
@section('title','DEPARTMENTS - EDIT')
@section('content')

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="bg-white shadow-xl rounded-lg py-5 pl-5 pr-8 h-full max-h-full overflow-y-auto">
            <form action="{{ route('departments.update', ['key' => $key]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 w-full">
                    <label for="name" class="block text-sm font-semibold text-gray-600">Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ $department->name }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required autocomplete="off">
                </div>

                <div class="mt-5 flex gap-x-8">
                    <button class="bg-blue-500 w-1/2 py-2 rounded-lg text-white font-bold tracking-wider hover:scale-105">UPDATE</button>
                    <a href="{{ route('departments.index') }}" class="bg-gray-500 w-1/2 py-2 rounded-lg text-white font-bold tracking-wider hover:scale-105 text-center">BACK</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#role').change(function(){
                var role = $(this).val();
                if(role == 2){
                    $('#colorDiv').removeClass('opacity-50');
                    $('#color').prop('disabled', false);
                }else{
                    $('#colorDiv').addClass('opacity-50');
                    $('#color').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
