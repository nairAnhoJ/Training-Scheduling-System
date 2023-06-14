<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 
Route::get('/', function () {
    if(!Auth::user()){

        $events = DB::table('requests')
            ->select('customers.name', 'requests.category', 'requests.unit_type', 'requests.billing_type', 'customers.area', 'requests.trainer', 'requests.updated_at', 'requests.key', 'requests.training_date', 'requests.id', 'users.id as uid', 'users.first_name', 'users.last_name', 'users.color')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->join('users', 'requests.trainer', '=', 'users.id')
            ->where('is_approved', 1)
            ->get();

        $eventArray = [];
        foreach ($events as $event) { 
            // Create a new array for each iteration
            $newArray = [];
        
            // Populate the new array with desired values
            $newArray = [
                'id' => $event->id,
                'title' => $event->name,
                'start' => date('Y-m-d', strtotime($event->training_date)),
                'color' => $event->color,
            ];
        
            // Push the new array into the result array
            $eventArray[] = $newArray;
        }

        return view('landing', compact('events', 'eventArray'));
    }else{
        return redirect()->route('dashboard.index');
    }
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'auth'])->name('login.auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // REQUEST
    Route::get('/request', [RequestController::class, 'index'])->name('request.index');
    Route::get('/request/add', [RequestController::class, 'add'])->name('request.add');
    Route::post('/request/getcom', [RequestController::class, 'getcom'])->name('request.getcom');
    Route::post('/request/store', [RequestController::class, 'store'])->name('request.store');
    Route::post('/request/view', [RequestController::class, 'view'])->name('request.view');
    Route::get('/request/approve/{key}', [RequestController::class, 'approve']);
    Route::get('/request/view/contract-details/{key}', [RequestController::class, 'contractDetails']);
    Route::get('/request/edit/{key}', [RequestController::class, 'edit'])->name('request.edit');
    Route::post('/request/update/{key}', [RequestController::class, 'update'])->name('request.update');

    // USERS
    Route::get('/system-management/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/system-management/users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('/system-management/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/system-management/users/edit/{key}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/system-management/users/update/{key}', [UserController::class, 'update'])->name('users.update');
    Route::get('/system-management/users/delete/{key}', [UserController::class, 'delete'])->name('users.delete');

    // DEPARTMENTS
    Route::get('/system-management/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/system-management/departments/add', [DepartmentController::class, 'add'])->name('departments.add');
    Route::post('/system-management/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/system-management/departments/edit/{key}', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::post('/system-management/departments/update/{key}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::get('/system-management/departments/delete/{key}', [DepartmentController::class, 'delete'])->name('departments.delete');
});

Route::fallback(function () {
    return view('404');
});

