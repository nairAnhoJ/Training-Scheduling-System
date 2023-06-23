<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class TrainingController extends Controller
{
    public function index(){
        $requests = DB::table('requests')
            ->select('customers.name', 'customers.area', 'requests.trainer', 'requests.training_date', 'requests.status', 'requests.updated_at', 'requests.key', 'users.first_name', 'users.last_name')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->leftJoin('users', 'requests.trainer', '=', 'users.id')
            ->where('requests.is_approved', 1)
            ->where('requests.is_deleted', 0)
            ->orderByRaw("CASE WHEN requests.status = 'SCHEDULED' THEN 0 ELSE 1 END, requests.training_date ASC")
            // ->orderByRaw("FIELD(requests.status, 'SCHEDULED')")
            ->orderBy('requests.id', 'desc')
            ->get();

        $search = '';
        // $page = 1;
        return view('user.coordinator.trainings.index', compact('requests', 'search'));
    }

    public function search(Request $request){
        $search = $request->search;
        $requests = DB::table('requests')
            ->select('customers.name', 'requests.category', 'requests.unit_type', 'requests.billing_type', 'customers.area', 'requests.trainer', 'requests.updated_at', 'requests.key', 'users.first_name', 'users.last_name')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->leftJoin('users', 'requests.trainer', '=', 'users.id')
            ->whereRaw("CONCAT_WS(' ', customers.name, requests.category, requests.unit_type, requests.billing_type, customers.area, requests.updated_at, users.first_name, users.last_name) LIKE '%{$search}%'")
            ->where('requests.is_approved', 1)
            ->where('requests.is_deleted', 0)
            ->orderBy('requests.id', 'desc')
            ->get();

        // $page = 1;
        return view('user.coordinator.trainings.index', compact('requests', 'search'));
    }

    public function edit($key){
        $request = DB::table('requests')
            ->select('customers.*', 'requests.*')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->where('requests.key', $key)
            ->first();
        $trainers = DB::table('users')->where('role', 2)->get();

        return view('user.coordinator.trainings.edit', compact('request', 'trainers', 'key'));
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
        $trainer = $request->trainer;
        $remarks = $request->remarks;

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
                    'trainer' => $trainer,
                    'remarks' => $remarks,
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
                    'trainer' => $trainer,
                    'remarks' => $remarks,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }

        return redirect()->route('trainings.index')->with('success', 'Request Successfully Updated');
    }

    public function delete($key){
        DB::table('requests')->where('key', $key)->update([
            'is_deleted' => 1
        ]);
        
        return redirect()->route('trainings.index')->with('success', 'Request Successfully Deleted');
    }

    public function view(Request $request){
        $key = $request->key;
        $thisRequest = DB::table('requests')
            // ->select('customers.*', 'requests.*', 'users.*')
            ->select('customers.name', 'customers.address', 'customers.area', 'customers.cp1_name', 'customers.cp1_number', 'customers.cp1_email', 'customers.cp2_name', 'customers.cp2_number', 'customers.cp2_email', 'customers.cp3_name', 'customers.cp3_number', 'customers.cp3_email', 'requests.category', 'requests.unit_type', 'requests.brand', 'requests.model', 'requests.no_of_unit', 'requests.billing_type', 'requests.is_PM', 'requests.contract_details', 'requests.no_of_attendees', 'requests.venue', 'requests.training_date', 'requests.knowledge_of_participants', 'requests.trainer', 'requests.remarks', 'requests.status', 'requests.key', 'users.first_name', 'users.last_name')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->leftJoin('users', 'requests.trainer', '=', 'users.id')
            ->where('requests.key', $key)
            ->first();

        $result = array(
            'event_date' => $thisRequest->training_date,
            'venue' => $thisRequest->venue,
            'trainer' => $thisRequest->first_name.' '.$thisRequest->last_name,
            'status' => $thisRequest->status,

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

            'category' => $thisRequest->category,
            'is_PM' => $thisRequest->is_PM,
            'unit_type' => $thisRequest->unit_type,
            'brand' => $thisRequest->brand,
            'model' => $thisRequest->model,
            'no_of_unit' => $thisRequest->no_of_unit,
            'billing_type' => $thisRequest->billing_type,
            'contract_details' => $thisRequest->contract_details,
            'no_of_attendees' => $thisRequest->no_of_attendees,
            'venue' => $thisRequest->venue,
            'training_date' => $thisRequest->training_date,
            'knowledge_of_participants' => $thisRequest->knowledge_of_participants,
            'remarks' => $thisRequest->remarks,
            'key' => $thisRequest->key,
        );

        echo json_encode($result);
    }

    public function contractDetails($key){
        $path = (DB::table('requests')->where('key', $key)->first())->contract_details;

        return view('user.coordinator.trainings.view-contract-details', compact('path'));
    }

    public function approve($key){
        DB::table('requests')->where('key', $key)->update([
            'status' => 'SCHEDULED',
            'is_approved' => 1,
        ]);

        return redirect()->route('trainings.index')->with('success', 'Request Has Been Approved');
    }

    public function cancel($key){
        DB::table('requests')->where('key', $key)->update([
            'status' => 'CANCELLED',
        ]);

        return redirect()->route('trainings.index')->with('success', 'Training Has Been Cancelled');
    }

    public function reschedule(Request $request){
        DB::table('requests')->where('key', $request->key)->update([
            'status' => 'SCHEDULED',
            'training_date' => $request->rescheduleDate,
        ]);

        return redirect()->route('trainings.index')->with('success', 'Training Has Been Rescheduled');
    }
}
