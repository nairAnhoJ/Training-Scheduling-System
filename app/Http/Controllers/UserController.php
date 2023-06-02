<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $users = DB::table('users')
            ->select('users.*', 'departments.name as dept')
            ->join('departments', 'users.dept_id', '=', 'departments.id')
            ->orderBy('users.first_name', 'asc')
            ->get();
        $search = '';
        return view('admin.users.index', compact('search', 'users'));
    }

    public function add(){
        $departments = DB::table('departments')->orderBy('name', 'asc')->get();

        return view('admin.users.add', compact('departments'));
    }

    public function store(Request $request){
        $color = '0';
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $id_number = $request->id_number;
        $department = $request->department;
        $email = $request->email;
        $role = $request->role;
        $color = $request->color;

        DB::table('users')
            ->insert([
                'id_number' => $id_number,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'dept_id' => $department,
                'email' => $email,
                'role' => $role,
                'color' => $color,
            ]);

        return redirect()->route('users.index')->with('success', 'User Successfully Added');
    }
}
