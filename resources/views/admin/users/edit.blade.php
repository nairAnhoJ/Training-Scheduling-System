@extends('layouts.app')
@section('title','USERS - EDIT')
@section('content')

    <div class="p-5 w-full h-[calc(100%-56px)] bg-gray-200">
        <div class="bg-white shadow-xl rounded-lg py-5 pl-5 pr-8 h-full max-h-full overflow-y-auto">
            <form action="{{ route('users.update', ['key' => $key]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="key" value="{{}}"> --}}
                <div>
                    <div class="mb-3 w-full">
                        <label for="first_name" class="block text-sm font-semibold text-gray-600">First Name <span class="text-red-500">*</span></label>
                        <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div class="mb-3 w-full">
                        <label for="last_name" class="block text-sm font-semibold text-gray-600">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div class="mb-3 w-full">
                        <label for="id_number" class="block text-sm font-semibold text-gray-600">ID Number <span class="text-red-500">*</span></label>
                        <input type="text" id="id_number" name="id_number" value="{{ $user->id_number }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required>
                    </div>

                    <div class="mb-3 {{ $user->id == 1 ? 'opacity-50' : '' }}">
                        <label for="department" class="block text-sm font-semibold text-gray-600">Department <span class="text-red-500">{{ $user->id == 1 ? '' : '*' }}</span></label>
                        <select {{ $user->id == 1 ? 'disabled' : '' }} id="department" name="department" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($departments as $department)
                                <option {{ $user->id_number == $department->id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 w-full">
                        <label for="email" class="block text-sm font-semibold text-gray-600">E-mail <span class="text-red-500">*</span></label>
                        <input type="text" id="email" name="email" value="{{ $user->email }}" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" required>
                    </div>

                    <div class="mb-3 {{ $user->id == 1 ? 'opacity-50' : '' }}">
                        <label for="role" class="block text-sm font-semibold text-gray-600">Role <span class="text-red-500">{{ $user->id == 1 ? '' : '*' }}</span></label>
                        <select {{ $user->id == 1 ? 'disabled' : '' }} id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option {{ $user->role == 0 ? 'selected' : '' }} value="0">Administrator</option>
                            <option {{ $user->role == 1 ? 'selected' : '' }} value="1">Training Coordinator</option>
                            <option {{ $user->role == 2 ? 'selected' : '' }} value="2">Trainer</option>
                            <option {{ $user->role == 3 ? 'selected' : '' }} value="3">Viewing Only</option>
                        </select>
                    </div>
                </div>

                <div id="colorDiv" class="mb-3 w-full {{ $user->role == 2 ? '' : 'opacity-50' }}">
                    <label for="color" class="block text-sm font-semibold text-gray-600">Color <span class="text-red-500">{{ $user->id == 1 ? '' : '*' }}</span></label>
                    <input {{ $user->role == 2 ? '' : 'disabled' }} type="color" id="color" name="color" id="favcolor" name="favcolor" value="{{ $user->role == 2 ? $user->color : '#3B82F6' }}" class="w-80 h-9">
                </div>

                <div class="mt-5 flex gap-x-8">
                    <button class="bg-blue-500 w-1/2 py-2 rounded-lg text-white font-bold tracking-wider hover:scale-105">UPDATE</button>
                    <a href="{{ route('users.index') }}" class="bg-gray-500 w-1/2 py-2 rounded-lg text-white font-bold tracking-wider hover:scale-105 text-center">BACK</a>
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
