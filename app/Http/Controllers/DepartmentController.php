<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::where('is_deleted', 0)
            ->orderBy('name', 'asc')
            ->get();
        $search = '';
        return view('admin.departments.index', compact('search', 'departments'));
    }

    public function add(){
        $departments = Department::where('is_deleted', 0)->orderBy('name', 'asc')->get();

        return view('admin.departments.add', compact('departments'));
    }

    public function store(Request $request){
        $name = strtoupper($request->name);

        $unique = false;
        $key = null;

        while (!$unique) {
            $key = Str::uuid()->toString();
            $existingModel = Department::where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        Department::insert([
                'name' => $name,
                'key' => $key,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('departments.index')->with('success', 'Department Successfully Added');
    }

    public function edit($key){
        $department = Department::where('key', $key)->first();

        return view('admin.departments.edit', compact('department', 'key'));
    }

    public function update(Request $request, $key){
        $name = strtoupper($request->name);

        Department::where('key', $key)
            ->update([
                'name' => $name,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('departments.index')->with('success', 'Department Successfully Updated');
    }

    public function delete($key){
        Department::where('key', $key)
            ->update([
                'is_deleted' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('departments.index')->with('success', 'Department Successfully Deleted');
    }
}
