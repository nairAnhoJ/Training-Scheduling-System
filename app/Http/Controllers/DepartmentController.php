<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index(){
        $departments = DB::table('departments')
            ->where('is_deleted', 0)
            ->orderBy('name', 'asc')
            ->get();
        $search = '';
        return view('admin.departments.index', compact('search', 'departments'));
    }

    public function add(){
        $departments = DB::table('departments')->where('is_deleted', 0)->orderBy('name', 'asc')->get();

        return view('admin.departments.add', compact('departments'));
    }

    public function store(Request $request){
        $name = strtoupper($request->name);

        $unique = false;
        $key = null;

        while (!$unique) {
            $key = Str::uuid()->toString();
            $existingModel = DB::table('departments')->where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        DB::table('departments')
            ->insert([
                'name' => $name,
                'key' => $key,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('departments.index')->with('success', 'Department Successfully Added');
    }

    public function edit($key){
        $department = DB::table('departments')->where('key', $key)->first();

        return view('admin.departments.edit', compact('department', 'key'));
    }

    public function update(Request $request, $key){
        $name = strtoupper($request->name);

        DB::table('departments')
            ->where('key', $key)
            ->update([
                'name' => $name,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('departments.index')->with('success', 'Department Successfully Updated');
    }

    public function delete($key){
        DB::table('departments')
            ->where('key', $key)
            ->update([
                'is_deleted' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('departments.index')->with('success', 'Department Successfully Deleted');
    }
}
