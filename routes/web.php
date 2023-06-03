<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('landing');
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

    // USERS
    Route::get('/system-management/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/system-management/users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('/system-management/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/system-management/users/edit/{key}', [UserController::class, 'edit'])->name('users.edit');
});

Route::fallback(function () {
    return view('404');
});

