
<nav class="w-screen bg-blue-500 h-14 shadow-lg">
    <div class="grid grid-cols-3 h-full">

        <div class="h-full">
            <div class="flex items-center h-full">
               <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mx-3 text-sm text-blue-600 rounded-lg bg-white hover:scale-105 shadow-xl"> 
                   <span class="sr-only">Open sidebar</span>
                   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                   </svg>
                </button>
                <h1 id="pageTitle" class="whitespace-nowrap mt-1 uppercase font-bold text-xl tracking-wider text-white">@yield('title')</h1>
            </div>
        </div>

        <div class="h-full justify-self-center">
            <div class="flex items-center h-full text-white text-xl font-bold">
               {{ date('F j, Y') }}
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="w-36 h-full p-2.5 justify-self-end">
            @csrf
            <button type="submit" class="bg-white text-blue-600 w-full h-full rounded-xl hover:scale-105 shadow-lg font-black tracking-wider flex justify-center items-center">
                <span>LOGOUT</span>
            </button>
        </form>

    </div>
</nav>


<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
       <ul class="space-y-2 font-medium">
          <li>
             <a href="{{ route('dashboard.index') }}" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-300 hover:text-gray-700 border-gray-300 {{ (Str::contains(url()->current(), url('/dashboard'))) ? 'scale-105 bg-gray-300 border border-gray-300 shadow' : '' }}">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 -960 960 960"><path xmlns="http://www.w3.org/2000/svg" d="M180-80q-24 0-42-18t-18-42v-620q0-24 18-42t42-18h65v-60h65v60h340v-60h65v60h65q24 0 42 18t18 42v620q0 24-18 42t-42 18H180Zm0-60h600v-430H180v430Zm0-490h600v-130H180v130Zm0 0v-130 130Zm300 230q-17 0-28.5-11.5T440-440q0-17 11.5-28.5T480-480q17 0 28.5 11.5T520-440q0 17-11.5 28.5T480-400Zm-160 0q-17 0-28.5-11.5T280-440q0-17 11.5-28.5T320-480q17 0 28.5 11.5T360-440q0 17-11.5 28.5T320-400Zm320 0q-17 0-28.5-11.5T600-440q0-17 11.5-28.5T640-480q17 0 28.5 11.5T680-440q0 17-11.5 28.5T640-400ZM480-240q-17 0-28.5-11.5T440-280q0-17 11.5-28.5T480-320q17 0 28.5 11.5T520-280q0 17-11.5 28.5T480-240Zm-160 0q-17 0-28.5-11.5T280-280q0-17 11.5-28.5T320-320q17 0 28.5 11.5T360-280q0 17-11.5 28.5T320-240Zm320 0q-17 0-28.5-11.5T600-280q0-17 11.5-28.5T640-320q17 0 28.5 11.5T680-280q0 17-11.5 28.5T640-240Z"/></svg>
               <span class="ml-3">Schedule Board</span>
             </a>
          </li>
          <li>
             <a href="{{ route('request.index') }}" class="flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-300 hover:text-gray-700 border-gray-300 {{ (Str::contains(url()->current(), url('/request'))) ? 'scale-105 bg-gray-300 border border-gray-300 shadow' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path d="M349-250h262q12.75 0 21.375-8.675 8.625-8.676 8.625-21.5 0-12.825-8.625-21.325T611-310H349q-12.75 0-21.375 8.675-8.625 8.676-8.625 21.5 0 12.825 8.625 21.325T349-250Zm0-170h262q12.75 0 21.375-8.675 8.625-8.676 8.625-21.5 0-12.825-8.625-21.325T611-480H349q-12.75 0-21.375 8.675-8.625 8.676-8.625 21.5 0 12.825 8.625 21.325T349-420ZM220-80q-24 0-42-18t-18-42v-680q0-24 18-42t42-18h336q12.444 0 23.722 5T599-862l183 183q8 8 13 19.278 5 11.278 5 23.722v496q0 24-18 42t-42 18H220Zm331-584v-156H220v680h520v-494H581q-12.75 0-21.375-8.625T551-664ZM220-820v186-186 680-680Z"/></svg>
                <span class="ml-3">Request</span>
             </a>
          </li>
          @if (Auth::user()->role == 0)
            <li>
               <button type="button" class="flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg group hover:bg-gray-300 hover:text-gray-700 {{ (Str::contains(url()->current(), url('/system-management/users'))) || (Str::contains(url()->current(), url('/system-management/departments'))) ? 'scale-105 bg-gray-300 border border-gray-300 shadow' : '' }}" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" viewBox="0 -960 960 960" fill="currentColor"><path xmlns="http://www.w3.org/2000/svg" d="m388-80-20-126q-19-7-40-19t-37-25l-118 54-93-164 108-79q-2-9-2.5-20.5T185-480q0-9 .5-20.5T188-521L80-600l93-164 118 54q16-13 37-25t40-18l20-127h184l20 126q19 7 40.5 18.5T669-710l118-54 93 164-108 77q2 10 2.5 21.5t.5 21.5q0 10-.5 21t-2.5 21l108 78-93 164-118-54q-16 13-36.5 25.5T592-206L572-80H388Zm92-270q54 0 92-38t38-92q0-54-38-92t-92-38q-54 0-92 38t-38 92q0 54 38 92t92 38Zm0-60q-29 0-49.5-20.5T410-480q0-29 20.5-49.5T480-550q29 0 49.5 20.5T550-480q0 29-20.5 49.5T480-410Zm0-70Zm-44 340h88l14-112q33-8 62.5-25t53.5-41l106 46 40-72-94-69q4-17 6.5-33.5T715-480q0-17-2-33.5t-7-33.5l94-69-40-72-106 46q-23-26-52-43.5T538-708l-14-112h-88l-14 112q-34 7-63.5 24T306-642l-106-46-40 72 94 69q-4 17-6.5 33.5T245-480q0 17 2.5 33.5T254-413l-94 69 40 72 106-46q24 24 53.5 41t62.5 25l14 112Z"/></svg>
                     <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>System Management</span>
                     <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
               </button>
               <ul id="dropdown-example" class="hidden py-2 space-y-2">
                     <li>
                        <a href="{{ route('users.index') }}" class="flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 hover:text-gray-700 {{ (Str::contains(url()->current(), url('/system-management/users'))) ? 'scale-105 bg-gray-300 border border-gray-300 shadow' : '' }}">Users</a>
                     </li>
                     <li>
                        <a href="{{ route('departments.index') }}" class="flex items-center w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 hover:text-gray-700 {{ (Str::contains(url()->current(), url('/system-management/departments'))) ? 'scale-105 bg-gray-300 border border-gray-300 shadow' : '' }}">Departments</a>
                     </li>
               </ul>
            </li>
          @endif
       </ul>
    </div>
 </aside>