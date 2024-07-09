<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $settings = Setting::where('id', 1)->first();

        return view('admin.settings.index', compact('settings'));
    }

    public function save(Request $request){
        $settings = Setting::where('id', 1)->first();
        $settings->control_number = $request->control_number;
        $settings->save();

        return redirect()->route('settings.index')->with('success', 'Settings Updated Successfully');
    }
}
