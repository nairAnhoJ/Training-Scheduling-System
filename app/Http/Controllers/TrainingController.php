<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Logs;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class TrainingController extends Controller
{
    public function index(){
        $requests = ModelsRequest::select('customers.name', 'customers.area', 'tss_requests.trainer', 'tss_requests.training_date', 'tss_requests.status', 'tss_requests.updated_at', 'tss_requests.key', 'tss_users.first_name', 'tss_users.last_name')
            ->join('customers', 'tss_requests.customer_id', '=', 'customers.id')
            ->leftJoin('tss_users', 'tss_requests.trainer', '=', 'tss_users.id')
            ->where('tss_requests.is_approved', 1)
            ->where('tss_requests.is_deleted', 0)
            ->orderByRaw("CASE WHEN tss_requests.status = 'SCHEDULED' THEN 0 ELSE 1 END, tss_requests.training_date ASC")
            ->orderBy('tss_requests.id', 'desc')
            ->get();

        $search = '';
        // $page = 1;
        return view('user.coordinator.trainings.index', compact('requests', 'search'));
    }

    public function search(Request $request){
        $search = $request->search;
        $requests = ModelsRequest::select('customers.name', 'customers.area', 'tss_requests.trainer', 'tss_requests.training_date', 'tss_requests.status', 'tss_requests.updated_at', 'tss_requests.key', 'tss_users.first_name', 'tss_users.last_name')
            ->join('customers', 'tss_requests.customer_id', '=', 'customers.id')
            ->leftJoin('tss_users', 'tss_requests.trainer', '=', 'tss_users.id')
            ->whereRaw("CONCAT_WS(' ', customers.name, tss_requests.category, tss_requests.unit_type, tss_requests.billing_type, customers.area, tss_requests.updated_at, tss_users.first_name, tss_users.last_name) LIKE '%{$search}%'")
            ->where('tss_requests.is_approved', 1)
            ->where('tss_requests.is_deleted', 0)
            ->orderBy('tss_requests.id', 'desc')
            ->get();

        // $page = 1;
        return view('user.coordinator.trainings.index', compact('requests', 'search'));
    }

    public function edit($key){
        $request = ModelsRequest::select('customers.*', 'tss_requests.*')
            ->join('customers', 'tss_requests.customer_id', '=', 'customers.id')
            ->where('tss_requests.key', $key)
            ->first();
        $trainers = User::where('role', 2)->get();

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
        $reqmodel = strtoupper($request->model);
        $unit_type = $request->unit_type;
        $no_of_unit = $request->no_of_unit;
        $billing_type = $request->billing_type;
        $no_of_attendees = $request->no_of_attendees;
        $knowledge_of_participants = $request->knowledge_of_participants;
        $venue = strtoupper($request->venue);
        $event_date = $request->event_date;
        $trainer = $request->trainer;
        $remarks = $request->remarks;


        $model = Customer::where('name', $name)->firstOrFail();
        $originalData = $model->toArray();

        $data = $request->except('_token', 'category', 'contract_details', 'brand', 'model', 'unit_type', 'no_of_unit', 'billing_type', 'no_of_attendees', 'knowledge_of_participants', 'venue', 'event_date', 'trainer', 'remarks');
        $data['address'] = $address;
        $data['area'] = $area;
        $data['cp1_name'] = $cp1_name;
        $data['cp1_number'] = $cp1_number;
        $data['cp1_email'] = $cp1_email;
        $data['cp2_name'] = $cp2_name;
        $data['cp2_number'] = $cp2_number;
        $data['cp2_email'] = $cp2_email;
        $data['cp3_name'] = $cp3_name;
        $data['cp3_number'] = $cp3_number;
        $data['cp3_email'] = $cp3_email;
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
                $changed = 'Contact Person 2 Name';
            }else if($column == 'cp2_number'){
                $changed = 'Contact Person 2 Number';
            }else if($column == 'cp2_email'){
                $changed = 'Contact Person 2 Email';
            }else if($column == 'cp3_name'){
                $changed = 'Contact Person 3 Name';
            }else if($column == 'cp3_number'){
                $changed = 'Contact Person 3 Number';
            }else if($column == 'cp3_email'){
                $changed = 'Contact Person 3 Email';
            }else{
                $changed = ucfirst($column);
            }

            $log = new Logs();
            $log->table = 'CUSTOMERS';
            $log->table_key = $key;
            $log->action = 'UPDATE';
            $log->description = $model->name;
            $log->field = $changed;
            $log->before = $originalData[$column];
            $log->after = $data[$column];
            $log->user_id = Auth::id();
            $log->save();
        }

        $contract_details_path = null;
        if($contract_details != null){
            $nid = ModelsRequest::latest('id')->value('id');
            if($nid != null){
                $nid += $nid;
            }else{
                $nid = 1;
            }

            $filename = 'R_'.$nid.'_'.date('md_Y').'.'.$request->file('contract_details')->getClientOriginalExtension();
            $path = "files/contract_details/";
            $contract_details_path = $path.$filename;
            $request->file('contract_details')->move(public_path('storage/'.$path), $filename);


            $model = ModelsRequest::where('key', $key)->firstOrFail();
            $originalData = $model->toArray();
    
            $data = $request->except('_token', 'name', 'address', 'area', 'cp1_name', 'cp1_number', 'cp1_email', 'cp2_name', 'cp2_number', 'cp2_email', 'cp3_name', 'cp3_number', 'cp3_email');
            $data['category'] = $category;
            $data['is_PM'] = 1;
            $data['contract_details'] = $contract_details_path;
            $data['unit_type'] = $unit_type;
            $data['brand'] = $brand;
            $data['model'] = $reqmodel;
            $data['no_of_unit'] = $no_of_unit;
            $data['billing_type'] = $billing_type;
            $data['no_of_attendees'] = $no_of_attendees;
            $data['venue'] = $venue;
            $data['training_date'] = $event_date;
            $data['knowledge_of_participants'] = $knowledge_of_participants;
            $data['trainer'] = $trainer;
            $data['remarks'] = $remarks;
            $data['updated_at'] = Carbon::now();
            $model->update($data);

            $changedColumns = array_keys(array_diff_assoc($data, $originalData));
            $changedColumns = array_diff($changedColumns, ['updated_at','event_date','is_PM']);
    
            foreach ($changedColumns as $column) {
                $changed = '';
    
                if($column == 'knowledge_of_participants'){
                    $changed = 'Knowledge of Participants';
                }else if($column == 'contract_details_path'){
                    $changed = 'Contract Details';
                }else if($column == 'unit_type'){
                    $changed = 'Unit Type';
                }else if($column == 'billing_type'){
                    $changed = 'Billing Type';
                }else if($column == 'no_of_attendees'){
                    $changed = 'Number of Attendees';
                }else if($column == 'no_of_unit'){
                    $changed = 'Number of Unit';
                }else if($column == 'training_date'){
                    $changed = 'Training Date';
                }else{
                    $changed = ucfirst($column);
                }
    
                $log = new Logs();
                $log->table = 'REQUEST';
                $log->table_key = $key;
                $log->action = 'UPDATE';
                $log->description = $model->number;
                $log->field = $changed;
                $log->before = $originalData[$column];
                // if($column == 'contract_details'){
                //     $column = 'contract_details_path';
                // }
                $log->after = $data[$column];
                $log->user_id = Auth::id();
                $log->save();
            }
        }else{

            $model = ModelsRequest::where('key', $key)->firstOrFail();
            $originalData = $model->toArray();
    
            $data = $request->except('_token', 'name', 'address', 'area', 'cp1_name', 'cp1_number', 'cp1_email', 'cp2_name', 'cp2_number', 'cp2_email', 'cp3_name', 'cp3_number', 'cp3_email');
            $data['category'] = $category;
            $data['unit_type'] = $unit_type;
            $data['brand'] = $brand;
            $data['model'] = $reqmodel;
            $data['no_of_unit'] = $no_of_unit;
            $data['billing_type'] = $billing_type;
            $data['no_of_attendees'] = $no_of_attendees;
            $data['venue'] = $venue;
            $data['training_date'] = $event_date;
            $data['knowledge_of_participants'] = $knowledge_of_participants;
            $data['trainer'] = $trainer;
            $data['remarks'] = $remarks;
            $data['updated_at'] = Carbon::now();
            $model->update($data);

    
            $changedColumns = array_keys(array_diff_assoc($data, $originalData));
            $changedColumns = array_diff($changedColumns, ['updated_at','event_date']);
    
            foreach ($changedColumns as $column) {
                $changed = '';
    
                if($column == 'knowledge_of_participants'){
                    $changed = 'Knowledge of Participants';
                }else if($column == 'unit_type'){
                    $changed = 'Unit Type';
                }else if($column == 'billing_type'){
                    $changed = 'Billing Type';
                }else if($column == 'no_of_attendees'){
                    $changed = 'Number of Attendees';
                }else if($column == 'no_of_unit'){
                    $changed = 'Number of Unit';
                }else if($column == 'training_date'){
                    $changed = 'Training Date';
                }else{
                    $changed = ucfirst($column);
                }
    
                $log = new Logs();
                $log->table = 'REQUEST';
                $log->table_key = $key;
                $log->action = 'UPDATE';
                $log->description = $model->number;
                $log->field = $changed;
                $log->before = $originalData[$column];
                $log->after = $data[$column];
                $log->user_id = Auth::id();
                $log->save();
            }
        }

        $ereq = ModelsRequest::where('key', $key)->firstOrFail();
        $ereq->end_date = $event_date;
        $ereq->save();
        

        return redirect()->route('trainings.index')->with('success', 'Request Successfully Updated');
    }

    public function delete($key){
        ModelsRequest::where('key', $key)->update([
            'is_deleted' => 1
        ]);

        $req = ModelsRequest::where('key', $key)->firstOrFail();

        $log = new Logs();
        $log->table = 'REQUEST';
        $log->table_key = $key;
        $log->action = "DELETE";
        $log->description = 'Request Number >> '.$req->number;
        $log->before = '';
        $log->after = '';
        $log->user_id = Auth::id();
        $log->save();
        
        return redirect()->route('trainings.index')->with('success', 'Request Successfully Deleted');
    }

    public function view(Request $request){
        $key = $request->key;
        $thisRequest = ModelsRequest::select('customers.name', 'customers.address', 'customers.area', 'customers.cp1_name', 'customers.cp1_number', 'customers.cp1_email', 'customers.cp2_name', 'customers.cp2_number', 'customers.cp2_email', 'customers.cp3_name', 'customers.cp3_number', 'customers.cp3_email', 'tss_requests.number', 'tss_requests.category', 'tss_requests.unit_type', 'tss_requests.brand', 'tss_requests.model', 'tss_requests.no_of_unit', 'tss_requests.billing_type', 'tss_requests.is_PM', 'tss_requests.contract_details', 'tss_requests.no_of_attendees', 'tss_requests.venue', 'tss_requests.training_date', 'tss_requests.knowledge_of_participants', 'tss_requests.trainer', 'tss_requests.remarks', 'tss_requests.status', 'tss_requests.key', 'tss_users.first_name', 'tss_users.last_name')
            ->join('customers', 'tss_requests.customer_id', '=', 'customers.id')
            ->leftJoin('tss_users', 'tss_requests.trainer', '=', 'tss_users.id')
            ->where('tss_requests.key', $key)
            ->first();

        $logs = Logs::with('user')
            ->where('tss_logs.table_key', $key)
            ->orderByDesc('id')
            ->get();

        $logRes = '';

        foreach($logs as $log){
            if($log->field == 'Training Date'){
                $color = 'text-blue-600';
            }else if($log->action == 'APPROVE' || $log->action == 'RESCHEDULE'){
                $color = 'text-emerald-600';
            }else if($log->action == 'CANCEL'){
                $color = 'text-red-600';
            }else{
                $color = '';
            }
            $logRes .= '
                <div class="text-sm mt-2">
                    <div class="flex justify-between bg-gray-200 px-1.5 py-0.5">
                        <p class="font-semibold">'.$log->created_at.'</p>
                        <p>'.$log->user->first_name.' '.$log->user->last_name.'</p>
                    </div>
                    <div id="logsDiv" class="pl-7">
                        <div class="'.$color.'">
                            • <span>'.ucfirst(strtolower($log->action)).'</span> <span>'.ucwords(strtolower($log->field)).'</span>: <span></span><span>'.$log->before.'</span> ⇒ <span>'.$log->after.'</span>
                        </div>
                    </div>
                </div>
            ';
        }

        $result = array(
            'req_number' => $thisRequest->number,
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

            'logRes' => $logRes,
        );

        echo json_encode($result);
    }

    public function contractDetails($key){
        $path = (ModelsRequest::where('key', $key)->first())->contract_details;

        return view('user.coordinator.trainings.view-contract-details', compact('path'));
    }

    public function approve($key){
        $req = ModelsRequest::where('key', $key)->firstOrFail();
        ModelsRequest::where('key', $key)->update([
            'status' => 'SCHEDULED',
            'end_date' => $req->training_date,
            'is_approved' => 1,
        ]);

        return redirect()->route('trainings.index')->with('success', 'Request Has Been Approved');
    }

    public function cancel($key){
        ModelsRequest::where('key', $key)->update([
            'status' => 'CANCELLED', 
        ]);

        $req = ModelsRequest::where('key', $key)->firstOrFail();

        $log = new Logs();
        $log->table = 'REQUEST';
        $log->table_key = $key;
        $log->action = "CANCEL";
        $log->description = 'Request Number >> '.$req->number;
        $log->before = '';
        $log->after = '';
        $log->user_id = Auth::id();
        $log->save();

        return redirect()->route('trainings.index')->with('success', 'Training Has Been Cancelled');
    }

    public function reschedule(Request $request){
        $req = ModelsRequest::where('key', $request->key)->firstOrFail();
        ModelsRequest::where('key', $request->key)->update([
            'status' => 'SCHEDULED',
            'training_date' => $request->rescheduleDate,
            'end_date' => $request->rescheduleDate,
        ]);

        $req = ModelsRequest::where('key', $request->key)->firstOrFail();

        $log = new Logs();
        $log->table = 'REQUEST';
        $log->table_key = $request->key;
        $log->action = "RESCHEDULE";
        $log->description = 'Request Number >> '.$req->number;
        $log->before = $req->training_date;
        $log->after = $request->rescheduleDate;
        $log->user_id = Auth::id();
        $log->save();

        return redirect()->route('trainings.index')->with('success', 'Training Has Been Rescheduled');
    }
}
