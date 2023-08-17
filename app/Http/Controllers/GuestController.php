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
        $thisRequest = ModelsRequest::select('customers.name', 'customers.address', 'customers.area', 'customers.cp1_name', 'customers.cp1_number', 'customers.cp1_email', 'customers.cp2_name', 'customers.cp2_number', 'customers.cp2_email', 'customers.cp3_name', 'customers.cp3_number', 'customers.cp3_email', 'tss_requests.number', 'tss_requests.category', 'tss_requests.unit_type', 'tss_requests.brand', 'tss_requests.model', 'tss_requests.no_of_unit', 'tss_requests.billing_type', 'tss_requests.is_PM', 'tss_requests.contract_details', 'tss_requests.no_of_attendees', 'tss_requests.venue', 'tss_requests.training_date', 'tss_requests.knowledge_of_participants', 'tss_requests.trainer', 'tss_requests.status', 'tss_requests.remarks', 'tss_requests.key', 'tss_users.first_name', 'tss_users.last_name')
            ->join('customers', 'tss_requests.customer_id', '=', 'customers.id')
            ->join('tss_users', 'tss_requests.trainer', '=', 'tss_users.id')
            ->where('tss_requests.key', $id)
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

        $event = Event::leftJoin('tss_users', 'tss_events.trainer', '=', 'tss_users.id')
            ->select('tss_events.*', DB::raw('IF(tss_events.trainer = 0, "#FE2C55", tss_users.color) as color'), DB::raw('IF(tss_events.trainer = 0, "ALL", tss_users.first_name) as fname'), DB::raw('IF(tss_events.trainer = 0, "", tss_users.last_name) as lname'))
            ->where('tss_events.key', $id)
            ->first();

        $result = array(
            'description' => $event->description,
            'date' => $event->date,
            'trainer' => $event->fname.' '.$event->lname,
        );

        echo json_encode($result);
    }
}
