@extends('layouts.app')
@section('title', 'SURVEY QUESTIONS')
@section('content')

    @if(session('success'))
        <div id="alert-3" class="absolute left-1/2 -translate-x-1/2 top-16 z-[99] shadow-lg border border-emerald-500 w-[calc(100%-10px)] sm:w-[500px] flex p-4 mb-4 text-green-50 rounded-lg bg-emerald-500 transition-all duration-500" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button" id="notifCloseButton" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 hover:scale-105 inline-flex h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif
    
    {{-- DELETE MODAL --}}
        <div id="deleteModal" class="hidden absolute top-0 left-0 w-screen h-screen bg-gray-900 z-[109] !bg-opacity-50 overflow-hidden flex items-center justify-center p-5">
            <div class="w-5/6 bg-white rounded-lg max-w-sm">
                <!-- Modal content -->
                <form action="{{ route('survey.delete') }}" method="POST" class="relative h-full bg-white rounded-lg shadow">
                    @csrf
                    <input type="hidden" name="id" class="modalID">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Delete
                        </h3>
                        <button type="button" class="inline-flex items-center justify-center w-8 h-8 ml-auto text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 closeDeleteModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="!m-0 overflow-scroll sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="flex items-start justify-center px-10 py-4 overflow-x-hidden overflow-y-auto">
                        <div class="w-full text-sm">
                            <p>Are you sure you want to permanently delete this question?</p>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-red-200 text-sm font-bold md:w-24 w-1/2 py-2.5 focus:z-10">YES</button>
                        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-bold md:w-24 w-1/2 py-2.5 hover:text-gray-900 focus:z-10 closeDeleteModal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- DELETE MODAL// --}}

    <div class="w-full p-5 bg-gray-200">
        <div class="min-h-[calc(100vh-96px)] p-3 bg-white rounded-lg shadow-xl">
            <div class="p-4 overflow-hidden rounded-lg">

                {{-- CONTROLS --}}
                    @csrf
                    <div class="mb-3">
                        <div class="">
                            <div class="flex justify-between w-full mb-3 md:mb-0">
                                {{-- <a href="{{ route('exam.index') }}" class="flex items-center justify-center w-24 py-2 mt-px text-sm font-semibold text-gray-600 border border-gray-200 rounded-lg bg-gray-50 hover:scale-105 focus:ring-4 focus:ring-gray-300 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1 transition duration-75" fill="currentColor" viewBox="0 -960 960 960"><path d="m315-433 232 232-67 66-345-345 345-346 67 67-232 232h511v94H315Z"/></svg>
                                    <span>BACK</span>
                                </a> --}}
                                <a href="{{ route('survey.add') }}" class="flex items-center justify-center w-24 py-2 mt-px text-sm font-semibold text-white bg-blue-600 rounded-lg hover:scale-105 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1 transition duration-75" fill="currentColor" viewBox="0 -960 960 960"><path d="M440.391-190.391v-250h-250v-79.218h250v-250h79.218v250h250v79.218h-250v250h-79.218Z"/></svg>
                                    <span>ADD</span>
                                </a>
                            </div>
                        </div>
                    </div>
                {{-- CONTROLS END --}}

                <div>

                    {{-- TABLE --}}
                        <div class="hidden md:block">
                            <div id="inventoryTable" class="w-full overflow-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-600 uppercase bg-gray-100">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Action
                                            </th>
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Question
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                                Type
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($questions as $index => $question)
                                            <tr class="bg-white border-b requestRow hover:bg-gray-200 even:bg-gray-100">
                                                <td class="px-6 py-4 text-center whitespace-nowrap flex items-center gap-x-1">
                                                    <a href="{{ url('/survey-questions/edit?id='.$question->id) }}" class="text-sm font-semibold text-blue-600 editButton hover:underline">Edit</a> | 
                                                    <button type="button" data-id="{{ $question->id }}" class="text-sm font-semibold text-red-600 cursor-pointer deleteButton hover:underline">Delete</button> | 
                                                    <a href="{{ url('/survey-questions/up?id='.$question->id) }}" class="{{ ($index == 0) ? 'pointer-events-none text-neutral-600' : 'text-blue-600' }} text-sm font-semibold editButton border-b border-transparent hover:border-blue-600 flex items-center pt-[1px] pl-[5px]">
                                                        Up 
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor">
                                                            <path d="M434.5-151.87v-481.98L215.76-415.11 151.87-480 480-808.13 808.13-480l-63.89 64.89L525.5-633.85v481.98h-91Z"/>
                                                        </svg>
                                                    </a> | 
                                                    <a href="{{ url('/survey-questions/down?id='.$question->id) }}" class="{{ (($index+1) == $questions->count()) ? 'pointer-events-none text-neutral-600' : 'text-blue-600' }} text-sm font-semibold text-blue-600 editButton border-b border-transparent hover:border-blue-600 flex items-center pt-[1px] pl-[5px]">
                                                        Down 
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor">
                                                            <path xmlns="http://www.w3.org/2000/svg" d="M434.5-808.13v481.98L215.76-544.89 151.87-480 480-151.87 808.13-480l-63.89-64.89L525.5-326.15v-481.98h-91Z"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                                    <span data-key="{{ $question->key }}">
                                                        {{ $question->question }}
                                                    </span>
                                                </th>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $question->type }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    {{-- TABLE END --}}

                    {{-- INVENTORY LIST SMALL DEVICE --}}
                        <div class="overflow-auto md:hidden">
                            <div id="accordion-collapse" data-accordion="collapse">
                                @php
                                    $x = 1;
                                @endphp

                                @foreach ($questions as $question)
                                    <h2 id="accordion-collapse-heading-{{$x}}">
                                        <button type="button" class="flex items-center justify-between w-full px-3 py-1.5 text-sm font-semibold text-left text-gray-600 border  border-gray-200 {{ $x == 1 ? 'rounded-t-xl border-b-0' : 'border-b' }} hover:bg-gray-100 focus:bg-gray-200 focus:text-gray-700" data-accordion-target="#accordion-collapse-body-{{$x}}" aria-expanded="false" aria-controls="accordion-collapse-body-{{$x}}">
                                            <span>{{ $question->question }}</span>
                                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </h2>

                                    <div id="accordion-collapse-body-{{$x}}" class="hidden" aria-labelledby="accordion-collapse-heading-{{$x}}">
                                        <div class="px-3 py-1.5 font-light border border-b border-gray-200">
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Type</div>
                                                <div class="text-sm font-semibold ">
                                                    {{ $question->type }}
                                                </div>
                                            </div>
                                            {{-- <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Question</div>
                                                <div class="text-sm font-semibold ">
                                                    {{ $question->question }}
                                                </div>
                                            </div> --}}
                                            <div class="grid grid-cols-2">
                                                <div class="text-xs leading-5">Action</div>
                                                <div class="">
                                                    <a href="{{ url('/survey-questions/edit?id='.$question->id) }}" class="text-sm font-semibold text-blue-600 hover:underline">Edit</a> | 
                                                    <button type="button" data-id="{{ $question->id }}" class="text-sm font-semibold text-red-600 deleteButton hover:underline">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        $x++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                    {{-- INVENTORY LIST SMALL DEVICE END --}}

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.deleteButton').on('click', function(){
                var id = $(this).data('id');
                $('.modalID').val(id);

                $('#deleteModal').removeClass('hidden');
            });

            $('.closeDeleteModal').on('click', function(){
                $('#deleteModal').addClass('hidden');
            });
        });
    </script>
@endsection
