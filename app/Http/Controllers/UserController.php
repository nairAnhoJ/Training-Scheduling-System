<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        $users = DB::table('users')
            ->select('users.*', 'departments.name as dept')
            ->join('departments', 'users.dept_id', '=', 'departments.id')
            ->where('users.is_deleted', 0)
            ->orderBy('users.first_name', 'asc')
            ->get();
        $search = '';
        return view('admin.users.index', compact('search', 'users'));
    }

    public function add(){
        $departments = DB::table('departments')->where('is_deleted', 0)->orderBy('name', 'asc')->get();

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
            $existingModel = DB::table('users')->where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        DB::table('users')
            ->insert([
                'id_number' => $id_number,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'dept_id' => $department,
                'email' => $email,
                'role' => $role,
                'color' => $color,
                'key' => $key,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('users.index')->with('success', 'User Successfully Added');
    }

    public function edit($key){
        $user = DB::table('users')->where('key', $key)->first();
        $departments = DB::table('departments')->orderBy('name', 'asc')->get();

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

        DB::table('users')
            ->where('key', $key)
            ->update([
                'id_number' => $id_number,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'dept_id' => $department,
                'email' => $email,
                'role' => $role,
                'color' => $color,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('users.index')->with('success', 'User Successfully Updated');
    }

    public function reset($key){
        DB::table('users')
            ->where('key', $key)
            ->update([
                'password' => '$2y$10$7v4/HKTwejrkpXieBOVI3eXtiIvBI2ofaAvsTVLb/i6RPDFgwD5Mm',
                'first_time_login' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('users.index')->with('success', 'Password Reset Successful!');
    }

    public function delete($key){
        DB::table('users')
            ->where('key', $key)
            ->update([
                'is_deleted' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('users.index')->with('success', 'User Successfully Deleted');
    }
}
