<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        $users = User::select('tss_users.*', 'departments.name as dept')
            ->join('departments', 'tss_users.dept_id', '=', 'departments.id')
            ->where('tss_users.is_deleted', 0)
            ->orderBy('tss_users.first_name', 'asc')
            ->get();
        $search = '';
        return view('admin.users.index', compact('search', 'users'));
    }

    public function add(){
        $departments = Department::where('is_deleted', 0)->orderBy('name', 'asc')->get();

        return view('admin.users.add', compact('departments'));
    }

    public function store(Request $request){
        $first_name = strtoupper($request->first_name);
        $last_name = strtoupper($request->last_name);
        $id_number = $request->id_number;
        $department = $request->department;
        $email = $request->email;
        $role = $request->role;
        $color = $request->color;
        if($color == ''){
            $color = '0';
        }

        $unique = false;
        $key = null;

        while (!$unique) {
            $key = Str::uuid()->toString();
            $existingModel = User::where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        $filename = $id_number . '.' . $request->file('signature')->getClientOriginalExtension();
        $path = "users/signatures/";
        $signature_path = $path . $filename;
        $request->file('signature')->move(public_path('storage/' . $path), $filename);

        if($role == 3){
            User::where('role', 3)
                ->update([
                    'role' => 2,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }

        User::insert([
                'id_number' => $id_number,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'dept_id' => $department,
                'email' => $email,
                'role' => $role,
                'color' => $color,
                'signature' => $signature_path,
                'key' => $key,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('users.index')->with('success', 'User Successfully Added');
    }

    public function edit($key){
        $user = User::where('key', $key)->first();
        $departments = Department::orderBy('name', 'asc')->get();

        return view('admin.users.edit', compact('departments', 'user', 'key'));
    }

    public function update(Request $request, $key){
        $first_name = strtoupper($request->first_name);
        $last_name = strtoupper($request->last_name);
        $id_number = $request->id_number;
        $department = $request->department;
        $email = $request->email;
        $role = $request->role;
        $color = $request->color;
        if($color == ''){
            $color = '0';
        }

        $user = User::where('key', $key)->first();
        $filePath = public_path($user->signature);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        if($role == 2 || $role == 3){
            $filename = $id_number . '.' . $request->file('signature')->getClientOriginalExtension();
            $path = "users/signatures/";
            $signature_path = $path . $filename;
            $request->file('signature')->move(public_path('storage/' . $path), $filename);
        }

        if($role == 3){
            User::where('role', 3)
                ->update([
                    'role' => 2,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }

        User::where('key', $key)
            ->update([
                'id_number' => $id_number,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'dept_id' => $department,
                'email' => $email,
                'role' => $role,
                'color' => $color,
                'signature' => $signature_path,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('users.index')->with('success', 'User Successfully Updated');
    }

    public function reset($key){
        User::where('key', $key)
            ->update([
                'password' => '$2y$10$7v4/HKTwejrkpXieBOVI3eXtiIvBI2ofaAvsTVLb/i6RPDFgwD5Mm',
                'first_time_login' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('users.index')->with('success', 'Password Reset Successful!');
    }

    public function delete($key){
        User::where('key', $key)
            ->update([
                'is_deleted' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('users.index')->with('success', 'User Successfully Deleted');
    }
}
