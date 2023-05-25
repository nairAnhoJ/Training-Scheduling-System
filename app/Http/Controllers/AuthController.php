<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request){
        $credentials = $request->validate([
            'id_number' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['id_number' => $credentials['id_number'], 'password' => $credentials['password']])) {
            // Authentication passed
            return redirect()->route('dashboard.index');
        }

        // Authentication failed
        return redirect()->back()->withInput()->withErrors([
            'error' => 'Invalid Credentials',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
