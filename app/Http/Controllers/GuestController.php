<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function view(Request $request){
        $id = $request->id;
        $thisRequest = ModelsRequest::select('customers.name', 'customers.address', 'customers.area', 'customers.cp1_name', 'customers.cp1_number', 'customers.cp1_email', 'customers.cp2_name', 'customers.cp2_number', 'customers.cp2_email', 'customers.cp3_name', 'customers.cp3_number', 'customers.cp3_email', 'requests.number', 'requests.category', 'requests.unit_type', 'requests.brand', 'requests.model', 'requests.no_of_unit', 'requests.billing_type', 'requests.is_PM', 'requests.contract_details', 'requests.no_of_attendees', 'requests.venue', 'requests.training_date', 'requests.knowledge_of_participants', 'requests.trainer', 'requests.status', 'requests.remarks', 'requests.key', 'users.first_name', 'users.last_name')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->join('users', 'requests.trainer', '=', 'users.id')
            ->where('requests.key', $id)
            ->first();

        $result = array(
            'status' => $thisRequest->status,
            'event_date' => $thisRequest->training_date,
            'venue' => $thisRequest->venue,
            'trainer' => $thisRequest->first_name.' '.$thisRequest->last_name,
            'training_number' => $thisRequest->number,

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

    public function event(Request $request){
        $id = $request->id;

        $event = Event::leftJoin('users', 'events.trainer', '=', 'users.id')
            ->select('events.*', DB::raw('IF(events.trainer = 0, "#FE2C55", users.color) as color'), DB::raw('IF(events.trainer = 0, "ALL", users.first_name) as fname'), DB::raw('IF(events.trainer = 0, "", users.last_name) as lname'))
            ->where('events.key', $id)
            ->first();

        $result = array(
            'description' => $event->description,
            'date' => $event->date,
            'trainer' => $event->fname.' '.$event->lname,
        );

        echo json_encode($result);
    }
}
