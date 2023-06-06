<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    public function index(){
        $requests = DB::table('requests')
            ->select('customers.name', 'requests.category', 'requests.unit_type', 'requests.billing_type', 'customers.area', 'requests.updated_at', 'requests.key')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->orderBy('requests.id', 'desc')
            ->get();

        $search = '';
        // $page = 1;
        return view('coordinator.request.index', compact('requests', 'search'));
    }

    public function add(){
        $customers = DB::table('customers')->get();

        return view('coordinator.request.add', compact('customers'));
    }

    public function getcom(Request $request){
        $id = $request->id;

        $customer = DB::table('customers')->where('id', $id)->first();

        $result = array(
            'address' => $customer->address,
            'area' => $customer->area,
            'cp1_name' => $customer->cp1_name,
            'cp1_number' => $customer->cp1_number,
            'cp1_email' => $customer->cp1_email,

            'cp2_name' => $customer->cp2_name,
            'cp2_number' => $customer->cp2_number,
            'cp2_email' => $customer->cp2_email,

            'cp3_name' => $customer->cp3_name,
            'cp3_number' => $customer->cp3_number,
            'cp3_email' => $customer->cp3_email,
        );

        echo json_encode($result);
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

        $category = $request->category;
        $contract_details = $request->contract_details;
        $brand = $request->brand;
        $model = strtoupper($request->model);
        $unit_type = $request->unit_type;
        $no_of_unit = $request->no_of_unit;
        $billing_type = $request->billing_type;
        $no_of_attendees = $request->no_of_attendees;
        $knowledge_of_participants = $request->knowledge_of_participants;
        $venue = strtoupper($request->venue);
        $event_date = $request->event_date;

        $com = DB::table('customers')
            ->where('name', $name)
            ->first();


        if($com != ''){
            DB::table('customers')
                ->where('name', $name)
                ->update([
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
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            $cusID = $com->id;
        }else{
            $unique = false;
            $key = null;
    
            while (!$unique) {
                $key = Str::uuid()->toString();
                $existingModel = DB::table('customers')->where('key', $key)->first();
                if (!$existingModel) {
                    $unique = true;
                }
            }

            $customer = DB::table('customers')
                ->insertGetId([
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
            $cusID = $customer;
        }

        $unique = false;
        $key = null;

        while (!$unique) {
            $key = Str::uuid()->toString();
            $existingModel = DB::table('requests')->where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        $contract_details_path = null;
        if($contract_details != null){
            $nid = DB::table('requests')->latest('id')->value('id');
            if($nid != null){
                $nid += $nid;
            }else{
                $nid = 1;
            }

            $filename = 'R_'.$nid.'_'.date('md_Y').'.'.$request->file('contract_details')->getClientOriginalExtension();
            $path = "files/contract_details/";
            $contract_details_path = $path.$filename;
            $request->file('contract_details')->move(public_path('storage/'.$path), $filename);

            DB::table('requests')
                ->insert([
                    'customer_id' => $cusID,
                    'category' => $category,
                    'contract_details' => $contract_details_path,
                    'unit_type' => $unit_type,
                    'brand' => $brand,
                    'model' => $model,
                    'no_of_unit' => $no_of_unit,
                    'billing_type' => $billing_type,
                    'no_of_attendees' => $no_of_attendees,
                    'venue' => $venue,
                    'training_date' => $event_date,
                    'knowledge_of_participants' => $knowledge_of_participants,
                    'key' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }else{
            DB::table('requests')
                ->insert([
                    'customer_id' => $cusID,
                    'category' => $category,
                    'unit_type' => $unit_type,
                    'brand' => $brand,
                    'model' => $model,
                    'no_of_unit' => $no_of_unit,
                    'billing_type' => $billing_type,
                    'no_of_attendees' => $no_of_attendees,
                    'venue' => $venue,
                    'training_date' => $event_date,
                    'knowledge_of_participants' => $knowledge_of_participants,
                    'key' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }

        return redirect()->route('request.index')->with('success', 'Request Successfully Added');
    }

    public function edit($key){
        $request = DB::table('requests')
            ->select('customers.*', 'requests.*')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->where('requests.key', $key)
            ->first();

        return view('coordinator.request.edit', compact('request', 'key'));
    }

    public function update(Request $request, $key){
        $name = strtoupper($request->name);
        $address = strtoupper($request->address);
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

        $category = $request->category;
        $contract_details = $request->contract_details;
        $brand = $request->brand;
        $model = strtoupper($request->model);
        $unit_type = $request->unit_type;
        $no_of_unit = $request->no_of_unit;
        $billing_type = $request->billing_type;
        $no_of_attendees = $request->no_of_attendees;
        $knowledge_of_participants = $request->knowledge_of_participants;
        $venue = strtoupper($request->venue);
        $event_date = $request->event_date;

        DB::table('customers')
            ->where('name', $name)
            ->update([
                'address' => $address,
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
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        $contract_details_path = null;
        if($contract_details != null){
            $nid = DB::table('requests')->latest('id')->value('id');
            if($nid != null){
                $nid += $nid;
            }else{
                $nid = 1;
            }

            $filename = 'R_'.$nid.'_'.date('md_Y').'.'.$request->file('contract_details')->getClientOriginalExtension();
            $path = "files/contract_details/";
            $contract_details_path = $path.$filename;
            $request->file('contract_details')->move(public_path('storage/'.$path), $filename);

            DB::table('requests')
                ->where('key', $key)
                ->update([
                    'category' => $category,
                    'contract_details' => $contract_details_path,
                    'unit_type' => $unit_type,
                    'brand' => $brand,
                    'model' => $model,
                    'no_of_unit' => $no_of_unit,
                    'billing_type' => $billing_type,
                    'no_of_attendees' => $no_of_attendees,
                    'venue' => $venue,
                    'training_date' => $event_date,
                    'knowledge_of_participants' => $knowledge_of_participants,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }else{
            DB::table('requests')
                ->where('key', $key)
                ->update([
                    'category' => $category,
                    'unit_type' => $unit_type,
                    'brand' => $brand,
                    'model' => $model,
                    'no_of_unit' => $no_of_unit,
                    'billing_type' => $billing_type,
                    'no_of_attendees' => $no_of_attendees,
                    'venue' => $venue,
                    'training_date' => $event_date,
                    'knowledge_of_participants' => $knowledge_of_participants,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }

        return redirect()->route('request.index')->with('success', 'Request Successfully Updated');
    }

    public function view(Request $request){
        $key = $request->key;
        $request = DB::table('requests')
            ->select('customers.*', 'requests.*')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->where('requests.key', $key)
            ->first();

        $result = array(
            'name' => $request->name,
        );

        echo json_encode($result);
    }
}
