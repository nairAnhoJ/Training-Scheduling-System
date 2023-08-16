<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function change(){
        if(Auth()->user()->first_time_login === '1'){
            return view('change-password');
        }else{
            return redirect()->route('users.index');
        }
    }

    public function changeConfirm(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
            // Other validation rules for the registration form
        ]);
    
        if ($validator->fails()) {
            if($request->password != $request->password_confirmation){
                return redirect()->back()->withInput()->withErrors([
                    'error' => 'The password you enter does not match.',
                ]);
            }else{
                return redirect()->back()->withInput()->withErrors([
                    'error' => 'Invalid Password.',
                ]);
            }
        }

        $hashedPassword = Hash::make($request->password);
        User::where('id', Auth::user()->id)->update([
            'password' => $hashedPassword,
            'first_time_login' => 0
        ]);

        return redirect()->route('dashboard.index');
    }
}
