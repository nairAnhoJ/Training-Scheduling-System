<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RequestController;
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

    Route::get('/request', [RequestController::class, 'index'])->name('request.index');
    Route::get('/request/add', [RequestController::class, 'add'])->name('request.add');
});

Route::fallback(function () {
    return view('404');
});

