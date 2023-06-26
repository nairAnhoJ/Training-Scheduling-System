<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Logs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(){
        $customers = DB::table('customers')
            ->where('is_deleted', 0)
            ->where('is_active', 1)
            ->orderBy('name', 'asc')
            ->get();
        $search = '';

        return view('user.coordinator.customer.index', compact('customers', 'search'));
    }

    public function search(Request $request){
        $search = $request->search;
        $customers = DB::table('customers')
            ->whereRaw("CONCAT_WS(' ', name, address, area) LIKE '%{$search}%'")
            ->where('is_deleted', 0)
            ->where('is_active', 1)
            ->orderBy('name', 'asc')
            ->get();

        return view('user.coordinator.customer.index', compact('customers', 'search'));
    }

    public function add(){

        return view('user.coordinator.customer.add');
    }

    public function store(Request $request){
        $name = strtoupper($request->name);
        $adress = strtoupper($request->adress);
        $area = $request->area;

        $cp1_name = strtoupper($request->cp1_name);
        $cp1_number = $request->cp1_number;
        $cp1_email = $request->cp1_email;

        $cp2_name = strtoupper($request->cp2_name);
        $cp2_number = $request->cp2_number;
        $cp2_email = $request->cp2_email;

        $cp3_name = strtoupper($request->cp3_name);
        $cp3_number = $request->cp3_number;
        $cp3_email = $request->cp3_email;

        $unique = false;
        $key = null;

        while (!$unique) {
            $key = Str::uuid()->toString();
            $existingModel = DB::table('customers')->where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        DB::table('customers')
            ->insert([
                'name' => $name,
                'address' => $adress,
                'area' => $area,
                'cp1_name' => $cp1_name,
                'cp1_number' => $cp1_number,
                'cp1_email' => $cp1_email,
                'cp2_name' => $cp2_name,
                'cp2_number' => $cp2_number,
                'cp2_email' => $cp2_email,
                'cp3_name' => $cp3_name,
                'cp3_number' => $cp3_number,
                'cp3_email' => $cp3_email,
                'key' => $key,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->route('customer.index')->with('success', 'Customer Successfully Added');
    }

    public function edit($key){
        $customer = DB::table('customers')
            ->where('key', $key)
            ->first();

        return view('user.coordinator.customer.edit', compact('customer', 'key'));
    }

    public function update(Request $request, $key){
        $model = Customer::where('key', $key)->firstOrFail();
        $originalData = $model->toArray();

        $data = $request->except('_token');
        $data['name'] = strtoupper($request->input('name'));
        $data['address'] = strtoupper($request->input('address'));
        $data['cp1_name'] = strtoupper($request->input('cp1_name'));
        $data['cp2_name'] = strtoupper($request->input('cp2_name'));
        $data['cp3_name'] = strtoupper($request->input('cp3_name'));
        $data['updated_at'] = Carbon::now();
        $model->update($data);

        $changedColumns = array_keys(array_diff_assoc($data, $originalData));
        $changedColumns = array_diff($changedColumns, ['updated_at']);

        foreach ($changedColumns as $column) {
            $changed = '';

            if($column == 'cp1_name'){
                $changed = 'Contact Person 1 Name';
            }else if($column == 'cp1_number'){
                $changed = 'Contact Person 1 Number';
            }else if($column == 'cp1_email'){
                $changed = 'Contact Person 1 Email';
            }else if($column == 'cp2_name'){
                $changed = 'Contact Person 1 Name';
            }else if($column == 'cp2_number'){
                $changed = 'Contact Person 1 Number';
            }else if($column == 'cp2_email'){
                $changed = 'Contact Person 1 Email';
            }else if($column == 'cp3_name'){
                $changed = 'Contact Person 1 Name';
            }else if($column == 'cp3_number'){
                $changed = 'Contact Person 1 Number';
            }else if($column == 'cp3_email'){
                $changed = 'Contact Person 1 Email';
            }else{
                $changed = ucfirst($column);
            }

            $log = new Logs();
            $log->table = 'CUSTOMERS';
            $log->table_key = $key;
            $log->action = 'UPDATE';
            $log->description = '>> '.$model->name.' { '.$changed.' }';
            $log->before = $originalData[$column];
            $log->after = $data[$column];
            $log->user_id = Auth::id();
            $log->save();
        }



        // $name = strtoupper($request->name);
        // $address = strtoupper($request->address);
        // $area = $request->area;

        // $cp1_name = strtoupper($request->cp1_name);
        // $cp1_number = $request->cp1_number;
        // $cp1_email = $request->cp1_email;

        // $cp2_name = strtoupper($request->cp2_name);
        // $cp2_number = $request->cp2_number;
        // $cp2_email = $request->cp2_email;

        // $cp3_name = strtoupper($request->cp3_name);
        // $cp3_number = $request->cp3_number;
        // $cp3_email = $request->cp3_email;
        
        // DB::table('customers')
        //     ->where('key', $key)
        //     ->update([
        //         'name' => $name,
        //         'address' => $address,
        //         'area' => $area,
        //         'cp1_name' => $cp1_name,
        //         'cp1_number' => $cp1_number,
        //         'cp1_email' => $cp1_email,
        //         'cp2_name' => $cp2_name,
        //         'cp2_number' => $cp2_number,
        //         'cp2_email' => $cp2_email,
        //         'cp3_name' => $cp3_name,
        //         'cp3_number' => $cp3_number,
        //         'cp3_email' => $cp3_email,
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ]);

        return redirect()->route('customer.index')->with('success', 'Customer Successfully Added');
    }

    public function delete($key){
        $cus = Customer::where('key', $key)->firstOrFail();
        Customer::where('key', $key)->update(['is_deleted' => 1]);
        // DB::table('customers')->where('key', $key)->update([
        //     'is_deleted' => 1
        // ]);

        $log = new Logs();
        $log->table = 'CUSTOMERS';
        $log->table_key = $key;
        $log->action = 'DELETE';
        $log->description = '>> Name { '.$cus->name.' }';
        $log->before = '';
        $log->after = '';
        $log->user_id = Auth::id();
        $log->save();
        
        return redirect()->route('customer.index')->with('success', 'Customer Successfully Deleted');
    }

    public function view(Request $request){
        $key = $request->key;
        $thisRequest = DB::table('customers')
            ->where('key', $key)
            ->first();

        $result = array(
            'name' => $thisRequest->name,
            'address' => $thisRequest->address,
            'area' => $thisRequest->area,

            'cp1_name' => $thisRequest->cp1_name,
            'cp1_number' => $thisRequest->cp1_number,
            'cp1_email' => $thisRequest->cp1_email,

            'cp2_name' => $thisRequest->cp2_name,
            'cp2_number' => $thisRequest->cp2_number,
            'cp2_email' => $thisRequest->cp2_email,

            'cp3_name' => $thisRequest->cp3_name,
            'cp3_number' => $thisRequest->cp3_number,
            'cp3_email' => $thisRequest->cp3_email,
        );

        echo json_encode($result);
    }
}
