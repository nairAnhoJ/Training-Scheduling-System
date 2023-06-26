<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(){

        $currentDate = date('Y-m-d');
        
        DB::table('requests')
            ->whereRaw('STR_TO_DATE(training_date, "%m/%d/%Y") < ?', [$currentDate])
            ->update(['status' => 'COMPLETED']);

        return view('login');
    }
}
