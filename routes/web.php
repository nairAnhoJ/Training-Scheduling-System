<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
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
        $trainers = DB::table('users')->where('role', 2)->where('is_active', 1)->get();

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

        return view('landing', compact('events', 'eventArray', 'trainers'));
    }else{
        return redirect()->route('dashboard.index');
    }
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/view', [GuestController::class, 'view'])->name('guest.view');
Route::post('/auth', [AuthController::class, 'auth'])->name('login.auth');

Route::middleware('auth')->group(function () {
    Route::get('/schedule-board', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/schedule-board/view', [DashboardController::class, 'view'])->name('dashboard.view');
    Route::get('/schedule-board/cancel/{key}', [DashboardController::class, 'cancel'])->name('dashboard.cancel');

    Route::post('/schedule-board/event/add', [EventController::class, 'add'])->name('event.add');
    Route::post('/schedule-board/event/view', [EventController::class, 'view'])->name('event.view');
    Route::get('/schedule-board/event/delete/{key}', [EventController::class, 'delete'])->name('event.delete');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // REQUEST
    Route::get('/request', [RequestController::class, 'index'])->name('request.index');
    Route::post('/request', [RequestController::class, 'search'])->name('request.search');
    Route::get('/request/add', [RequestController::class, 'add'])->name('request.add');
    Route::post('/request/getcom', [RequestController::class, 'getcom'])->name('request.getcom');
    Route::post('/request/store', [RequestController::class, 'store'])->name('request.store');
    Route::post('/request/view', [RequestController::class, 'view'])->name('request.view');
    Route::get('/request/approve/{key}', [RequestController::class, 'approve']);
    Route::get('/request/view/contract-details/{key}', [RequestController::class, 'contractDetails']);
    Route::get('/request/edit/{key}', [RequestController::class, 'edit'])->name('request.edit');
    Route::get('/request/delete/{key}', [RequestController::class, 'delete'])->name('request.delete');
    Route::post('/request/update/{key}', [RequestController::class, 'update'])->name('request.update');

    // TRAINING
    Route::get('/trainings', [TrainingController::class, 'index'])->name('trainings.index');
    Route::post('/trainings/view', [TrainingController::class, 'view'])->name('trainings.view');
    Route::post('/trainings/reschedule', [TrainingController::class, 'reschedule'])->name('trainings.reschedule');
    Route::get('/trainings/view/contract-details/{key}', [TrainingController::class, 'contractDetails']);
    Route::get('/trainings/edit/{key}', [TrainingController::class, 'edit'])->name('trainings.edit');
    Route::get('/trainings/delete/{key}', [TrainingController::class, 'delete'])->name('trainings.delete');
    Route::post('/trainings/update/{key}', [TrainingController::class, 'update'])->name('trainings.update');
    Route::get('/training/cancel/{key}', [TrainingController::class, 'cancel'])->name('dashboard.cancel');

    // CUSTOMER
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('/customer', [CustomerController::class, 'search'])->name('customer.search');
    Route::get('/customer/add', [CustomerController::class, 'add'])->name('customer.add');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('/customer/view', [CustomerController::class, 'view'])->name('customer.view');
    Route::get('/customer/edit/{key}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/customer/update/{key}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/customer/delete/{key}', [CustomerController::class, 'delete'])->name('customer.delete');

    // COMPANY
    Route::get('/company-list', [RequestController::class, 'index'])->name('company.index');

    // COMPANY
    Route::get('/scheduled-trainings', [RequestController::class, 'index'])->name('scheduled.index');
    

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

