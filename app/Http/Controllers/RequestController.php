<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Logs;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RequestController extends Controller {
    public function index() {
        $requests = ModelsRequest::select('customers.name', 'tss_requests.category', 'tss_requests.unit_type', 'tss_requests.billing_type', 'customers.area', 'tss_requests.trainer', 'tss_requests.updated_at', 'tss_requests.key', 'tss_users.first_name', 'tss_users.last_name')
            ->join('customers', 'tss_requests.customer_id', '=', 'customers.id')
            ->leftJoin('tss_users', 'tss_requests.trainer', '=', 'tss_users.id')
            ->where('tss_requests.is_approved', 0)
            ->where('tss_requests.is_deleted', 0)
            ->orderBy('tss_requests.id', 'desc')
            ->get();

        $search = '';
        // $page = 1;
        return view('user.coordinator.request.index', compact('requests', 'search'));
    }

    public function search(Request $request) {
        $search = $request->search;
        $requests = ModelsRequest::select('customers.name', 'tss_requests.category', 'tss_requests.unit_type', 'tss_requests.billing_type', 'customers.area', 'tss_requests.trainer', 'tss_requests.updated_at', 'tss_requests.key', 'tss_users.first_name', 'tss_users.last_name')
            ->join('customers', 'tss_requests.customer_id', '=', 'customers.id')
            ->leftJoin('tss_users', 'tss_requests.trainer', '=', 'tss_users.id')
            ->whereRaw("CONCAT_WS(' ', customers.name, tss_requests.category, tss_requests.unit_type, tss_requests.billing_type, customers.area, tss_requests.updated_at, tss_users.first_name, tss_users.last_name) LIKE '%{$search}%'")
            ->where('tss_requests.is_approved', 0)
            ->where('tss_requests.is_deleted', 0)
            ->orderBy('tss_requests.id', 'desc')
            ->get();

        // $page = 1;
        return view('user.coordinator.request.index', compact('requests', 'search'));
    }

    public function add() {
        $customers = Customer::get();
        $trainers = User::where('role', 2)->get();

        return view('user.coordinator.request.add', compact('customers', 'trainers'));
    }

    public function getcom(Request $request) {
        $id = $request->id;

        $customer = Customer::where('id', $id)->first();

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

    public function store(Request $request) {

        $id = ModelsRequest::orderBy('id', 'desc')->value('id') + 1;
        $user_id = Auth::user()->id;

        if ($id == null || $id == '') {
            $id = 1;
        }

        $nid = str_pad($id, 7, '0', STR_PAD_LEFT);

        $number = date('ym') . '-' . $user_id . '-' . $nid;

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

        $type = $request->type;
        $category = $request->category;
        $pm = $request->pm;
        $contract_details = $request->contract_details;
        $brand = $request->brand;
        $model = strtoupper($request->model);
        $unit_type = $request->unit_type;
        $no_of_unit = $request->no_of_unit;
        $billing_type = $request->billing_type;
        $no_of_attendees = $request->no_of_attendees;
        $knowledge_of_participants = $request->knowledge_of_participants;
        $venue = strtoupper($request->venue);
        $plan_start_date = $request->plan_start_date;
        $plan_end_date = $request->plan_end_date;
        $event_date = $request->event_date;
        $trainer = $request->trainer;
        $remarks = $request->remarks;

        $com = Customer::where('name', $name)
            ->first();


        if ($com != '') {
            Customer::where('name', $name)
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
        } else {
            $unique = false;
            $key = null;

            while (!$unique) {
                $key = Str::uuid()->toString();
                $existingModel = Customer::where('key', $key)->first();
                if (!$existingModel) {
                    $unique = true;
                }
            }

            $customer = Customer::insertGetId([
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
            $existingModel = ModelsRequest::where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        if ($pm == '1') {
            $contract_details_path = null;
            if ($contract_details != null) {
                $nid = ModelsRequest::latest('id')->value('id');
                if ($nid != null) {
                    $nid += $nid;
                } else {
                    $nid = 1;
                }

                $filename = 'R_' . $nid . '_' . date('md_Y') . '.' . $request->file('contract_details')->getClientOriginalExtension();
                $path = "files/contract_details/";
                $contract_details_path = $path . $filename;
                $request->file('contract_details')->move(public_path('storage/' . $path), $filename);

                ModelsRequest::insert([
                    'number' => $number,
                    'customer_id' => $cusID,
                    'category' => $category,
                    'is_PM' => 1,
                    'contract_details' => $contract_details_path,
                    'unit_type' => $unit_type,
                    'brand' => $brand,
                    'model' => $model,
                    'type' => $type,
                    'no_of_unit' => $no_of_unit,
                    'billing_type' => $billing_type,
                    'no_of_attendees' => $no_of_attendees,
                    'knowledge_of_participants' => $knowledge_of_participants,
                    'venue' => $venue,
                    'plan_start_date' => $plan_start_date,
                    'plan_end_date' => $plan_end_date,
                    'training_date' => $event_date,
                    'trainer' => $trainer,
                    'remarks' => $remarks,
                    'key' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                ModelsRequest::insert([
                    'number' => $number,
                    'customer_id' => $cusID,
                    'category' => $category,
                    'is_PM' => 1,
                    'unit_type' => $unit_type,
                    'brand' => $brand,
                    'model' => $model,
                    'type' => $type,
                    'no_of_unit' => $no_of_unit,
                    'billing_type' => $billing_type,
                    'no_of_attendees' => $no_of_attendees,
                    'knowledge_of_participants' => $knowledge_of_participants,
                    'venue' => $venue,
                    'plan_start_date' => $plan_start_date,
                    'plan_end_date' => $plan_end_date,
                    'training_date' => $event_date,
                    'trainer' => $trainer,
                    'remarks' => $remarks,
                    'key' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        } else {
            ModelsRequest::insert([
                'number' => $number,
                'customer_id' => $cusID,
                'category' => $category,
                'is_PM' => 0,
                'unit_type' => $unit_type,
                'brand' => $brand,
                'model' => $model,
                'type' => $type,
                'no_of_unit' => $no_of_unit,
                'billing_type' => $billing_type,
                'no_of_attendees' => $no_of_attendees,
                'knowledge_of_participants' => $knowledge_of_participants,
                'venue' => $venue,
                'plan_start_date' => $plan_start_date,
                'plan_end_date' => $plan_end_date,
                'training_date' => $event_date,
                'trainer' => $trainer,
                'remarks' => $remarks,
                'key' => $key,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->route('request.index')->with('success', 'Request Successfully Added');
    }

    public function edit($key) {
        $request = ModelsRequest::select('customers.*', 'tss_requests.*')
            ->join('customers', 'tss_requests.customer_id', '=', 'customers.id')
            ->where('tss_requests.key', $key)
            ->first();
        $trainers = User::where('role', 2)->get();

        return view('user.coordinator.request.edit', compact('request', 'trainers', 'key'));
    }

    public function update(Request $request, $key) {
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

        $type = $request->type;
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
        $plan_start_date = $request->plan_start_date;
        $plan_end_date = $request->plan_end_date;
        $event_date = $request->event_date;
        $trainer = $request->trainer;
        $remarks = $request->remarks;


        $model = Customer::where('name', $name)->firstOrFail();
        $originalData = $model->toArray();

        $data = $request->except('_token', 'type', 'category', 'contract_details', 'brand', 'model', 'unit_type', 'no_of_unit', 'billing_type', 'no_of_attendees', 'knowledge_of_participants', 'venue', 'plan_start_date', 'plan_end_date', 'event_date', 'trainer', 'remarks');
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

            if ($column == 'cp1_name') {
                $changed = 'Contact Person 1 Name';
            } else if ($column == 'cp1_number') {
                $changed = 'Contact Person 1 Number';
            } else if ($column == 'cp1_email') {
                $changed = 'Contact Person 1 Email';
            } else if ($column == 'cp2_name') {
                $changed = 'Contact Person 2 Name';
            } else if ($column == 'cp2_number') {
                $changed = 'Contact Person 2 Number';
            } else if ($column == 'cp2_email') {
                $changed = 'Contact Person 2 Email';
            } else if ($column == 'cp3_name') {
                $changed = 'Contact Person 3 Name';
            } else if ($column == 'cp3_number') {
                $changed = 'Contact Person 3 Number';
            } else if ($column == 'cp3_email') {
                $changed = 'Contact Person 3 Email';
            } else {
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
        if ($contract_details != null) {
            $nid = ModelsRequest::latest('id')->value('id');
            if ($nid != null) {
                $nid += $nid;
            } else {
                $nid = 1;
            }

            $filename = 'R_' . $nid . '_' . date('md_Y') . '.' . $request->file('contract_details')->getClientOriginalExtension();
            $path = "files/contract_details/";
            $contract_details_path = $path . $filename;
            $request->file('contract_details')->move(public_path('storage/' . $path), $filename);


            $model = ModelsRequest::where('key', $key)->firstOrFail();
            $originalData = $model->toArray();

            $data = $request->except('_token', 'name', 'address', 'area', 'cp1_name', 'cp1_number', 'cp1_email', 'cp2_name', 'cp2_number', 'cp2_email', 'cp3_name', 'cp3_number', 'cp3_email');
            $data['type'] = $type;
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
            $data['plan_start_date'] = $plan_start_date;
            $data['plan_end_date'] = $plan_end_date;
            $data['training_date'] = $event_date;
            $data['knowledge_of_participants'] = $knowledge_of_participants;
            $data['trainer'] = $trainer;
            $data['remarks'] = $remarks;
            $data['updated_at'] = Carbon::now();
            $model->update($data);

            $changedColumns = array_keys(array_diff_assoc($data, $originalData));
            $changedColumns = array_diff($changedColumns, ['updated_at', 'is_PM', 'event_date']);

            foreach ($changedColumns as $column) {
                $changed = '';

                if ($column == 'knowledge_of_participants') {
                    $changed = 'Knowledge of Participants';
                } else if ($column == 'contract_details_path') {
                    $changed = 'Contract Details';
                } else if ($column == 'unit_type') {
                    $changed = 'Unit Type';
                } else if ($column == 'billing_type') {
                    $changed = 'Billing Type';
                } else if ($column == 'no_of_attendees') {
                    $changed = 'Number of Attendees';
                } else if ($column == 'no_of_unit') {
                    $changed = 'Number of Unit';
                } else if ($column == 'training_date') {
                    $changed = 'Training Date';
                } else {
                    $changed = ucfirst($column);
                }

                $log = new Logs();
                $log->table = 'REQUEST';
                $log->table_key = $key;
                $log->action = 'UPDATE';
                $log->description = $model->number;
                $log->field = $changed;
                if ($column == 'trainer') {
                    if ($originalData[$column] != '' && $data[$column] != '') {
                        $before_trainer_name = User::where('id', $originalData[$column])->first();
                        $bname = $before_trainer_name->first_name . ' ' . $before_trainer_name->last_name;
                        $log->before = $bname;

                        $after_trainer_name = User::where('id', $data[$column])->first();
                        $aname = $after_trainer_name->first_name . ' ' . $after_trainer_name->last_name;
                        $log->after = $aname;
                    } else if ($originalData[$column] == '' && $data[$column] != '') {
                        $log->before = $originalData[$column];

                        $after_trainer_name = User::where('id', $data[$column])->first();
                        $aname = $after_trainer_name->first_name . ' ' . $after_trainer_name->last_name;
                        $log->after = $aname;
                    } else if ($originalData[$column] != '' && $data[$column] == '') {
                        $before_trainer_name = User::where('id', $originalData[$column])->first();
                        $bname = $before_trainer_name->first_name . ' ' . $before_trainer_name->last_name;
                        $log->before = $bname;

                        $log->after = $data[$column];
                    }
                } else {
                    $log->before = $originalData[$column];
                    $log->after = $data[$column];
                }
                $log->user_id = Auth::id();
                $log->save();
            }
        } else {

            $model = ModelsRequest::where('key', $key)->firstOrFail();
            $originalData = $model->toArray();

            $data = $request->except('_token', 'name', 'address', 'area', 'cp1_name', 'cp1_number', 'cp1_email', 'cp2_name', 'cp2_number', 'cp2_email', 'cp3_name', 'cp3_number', 'cp3_email');
            $data['type'] = $type;
            $data['category'] = $category;
            $data['unit_type'] = $unit_type;
            $data['brand'] = $brand;
            $data['model'] = $reqmodel;
            $data['no_of_unit'] = $no_of_unit;
            $data['billing_type'] = $billing_type;
            $data['no_of_attendees'] = $no_of_attendees;
            $data['venue'] = $venue;
            $data['plan_start_date'] = $plan_start_date;
            $data['plan_end_date'] = $plan_end_date;
            $data['training_date'] = $event_date;
            $data['knowledge_of_participants'] = $knowledge_of_participants;
            $data['trainer'] = $trainer;
            $data['remarks'] = $remarks;
            $data['updated_at'] = Carbon::now();
            $model->update($data);

            $changedColumns = array_keys(array_diff_assoc($data, $originalData));
            $changedColumns = array_diff($changedColumns, ['updated_at', 'event_date']);
            
            foreach ($changedColumns as $column) {
                $changed = '';

                if ($column == 'knowledge_of_participants') {
                    $changed = 'Knowledge of Participants';
                } else if ($column == 'unit_type') {
                    $changed = 'Unit Type';
                } else if ($column == 'billing_type') {
                    $changed = 'Billing Type';
                } else if ($column == 'no_of_attendees') {
                    $changed = 'Number of Attendees';
                } else if ($column == 'no_of_unit') {
                    $changed = 'Number of Unit';
                } else if ($column == 'plan_start_date') {
                    $changed = 'Plan Start Date';
                } else if ($column == 'plan_end_date') {
                    $changed = 'Plan End Date';
                } else if ($column == 'training_date') {
                    $changed = 'Training Date';
                } else {
                    $changed = ucfirst($column);
                }


                $log = new Logs();
                $log->table = 'REQUEST';
                $log->table_key = $key;
                $log->action = 'UPDATE';
                $log->description = $model->number;
                $log->field = $changed;
                if ($column == 'trainer') {
                    if ($originalData[$column] != '' && $data[$column] != '') {
                        $before_trainer_name = User::where('id', $originalData[$column])->first();
                        $bname = $before_trainer_name->first_name . ' ' . $before_trainer_name->last_name;
                        $log->before = $bname;

                        $after_trainer_name = User::where('id', $data[$column])->first();
                        $aname = $after_trainer_name->first_name . ' ' . $after_trainer_name->last_name;
                        $log->after = $aname;
                    } else if ($originalData[$column] == '' && $data[$column] != '') {
                        $log->before = $originalData[$column];

                        $after_trainer_name = User::where('id', $data[$column])->first();
                        $aname = $after_trainer_name->first_name . ' ' . $after_trainer_name->last_name;
                        $log->after = $aname;
                    } else if ($originalData[$column] != '' && $data[$column] == '') {
                        $before_trainer_name = User::where('id', $originalData[$column])->first();
                        $bname = $before_trainer_name->first_name . ' ' . $before_trainer_name->last_name;
                        $log->before = $bname;

                        $log->after = $data[$column];
                    }
                } else {
                    $log->before = $originalData[$column];
                    $log->after = $data[$column];
                }
                $log->user_id = Auth::id();
                $log->save();
            }
        }

        return redirect()->route('request.index')->with('success', 'Request Successfully Updated');
    }

    public function delete($key) {
        $req = ModelsRequest::where('key', $key)->firstOrFail();
        ModelsRequest::where('key', $key)->update([
            'is_deleted' => 1
        ]);

        $log = new Logs();
        $log->table = 'REQUEST';
        $log->table_key = $key;
        $log->action = "DELETE";
        $log->description = 'Request Number >> ' . $req->number;
        $log->before = '';
        $log->after = '';
        $log->user_id = Auth::id();
        $log->save();

        return redirect()->route('request.index')->with('success', 'Request Successfully Deleted');
    }

    public function view(Request $request) {
        $key = $request->key;
        $thisRequest = ModelsRequest::with('customer', 'trainerName')->where('tss_requests.key', $key)->first();

        $logs = Logs::with('user')
            ->where('tss_logs.table_key', $key)
            ->orderByDesc('id')
            ->get();

        $logRes = '';

        foreach ($logs as $log) {
            $logRes .= '
                <div class="mt-2 text-sm">
                    <div class="flex justify-between bg-gray-200 px-1.5 py-0.5">
                        <p class="font-semibold">' . $log->created_at . '</p>
                        <p>' . $log->user->first_name . ' ' . $log->user->last_name . '</p>
                    </div>
                    <div id="logsDiv" class="pl-7">
                        <div>
                            • <span>' . ucfirst(strtolower($log->action)) . '</span> <span>' . ucwords(strtolower($log->field)) . '</span>: <span></span><span>' . $log->before . '</span> ⇒ <span>' . $log->after . '</span>
                        </div>
                    </div>
                </div>
            ';
        }

        if ($thisRequest->trainerName != null) {
            $trainer_name = $thisRequest->trainerName->first_name . ' ' . $thisRequest->trainerName->last_name;
        } else {
            $trainer_name = null;
        }

        $result = array(
            'req_number' => $thisRequest->number,
            'status' => $thisRequest->status,
            'plan_start_date' => $thisRequest->plan_start_date,
            'plan_end_date' => $thisRequest->plan_end_date,
            'event_date' => $thisRequest->training_date,
            'venue' => $thisRequest->venue,
            'trainer' => $trainer_name,

            'name' => $thisRequest->customer->name,
            'address' => $thisRequest->customer->address,
            'area' => $thisRequest->customer->area,

            'cp1_name' => $thisRequest->customer->cp1_name,
            'cp1_number' => $thisRequest->customer->cp1_number,
            'cp1_email' => $thisRequest->customer->cp1_email,

            'cp2_name' => $thisRequest->customer->cp2_name,
            'cp2_number' => $thisRequest->customer->cp2_number,
            'cp2_email' => $thisRequest->customer->cp2_email,

            'cp3_name' => $thisRequest->customer->cp3_name,
            'cp3_number' => $thisRequest->customer->cp3_number,
            'cp3_email' => $thisRequest->customer->cp3_email,

            'type' => $thisRequest->type,
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

    public function contractDetails($key) {
        $path = (ModelsRequest::where('key', $key)->first())->contract_details;

        return view('user.coordinator.request.view-contract-details', compact('path'));
    }

    public function approve($key) {
        $req = ModelsRequest::where('key', $key)->firstOrFail();
        ModelsRequest::where('key', $key)->update([
            'status' => 'SCHEDULED',
            'is_approved' => 1,
            'end_date' => $req->training_date,
        ]);

        $req = ModelsRequest::where('key', $key)->firstOrFail();

        $log = new Logs();
        $log->table = 'REQUEST';
        $log->table_key = $key;
        $log->action = "APPROVE";
        $log->description = 'Request Number >> ' . $req->number;
        $log->before = '';
        $log->after = '';
        $log->user_id = Auth::id();
        $log->save();

        return redirect()->route('request.index')->with('success', 'Request Has Been Approved');
    }
}
