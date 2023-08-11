<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Customer;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('user.dashboard');
    }

    public function index(){

        $requestCount = DB::table('requests')->where('is_approved', 0)->where('is_deleted', 0)->where('status', 'PENDING')->count();
        $trainingCount = DB::table('requests')->where('is_approved', 1)->where('is_deleted', 0)->where('status', 'SCHEDULED')->count();

        $trainers = DB::table('users')->where('role', 2)->where('is_active', 1)->get();

        $events = DB::table('requests')
            ->select('requests.id', 'customers.name', 'requests.training_date', 'requests.end_date', 'requests.key', 'users.color', DB::raw('IFNULL(COUNT(comments.id), 0) as commentCount'))
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->join('users', 'requests.trainer', '=', 'users.id')
            ->leftJoin('comments', function ($join) {
                $join->on('requests.key', '=', 'comments.req_id')
                    ->where('comments.is_read', 0)
                    ->where('comments.user_id', Auth::user()->key);
            })
            ->where('is_approved', 1)
            ->whereIn('status', ['SCHEDULED', 'COMPLETED'])
            ->groupBy('requests.id', 'customers.name', 'requests.training_date', 'requests.end_date', 'requests.key', 'users.color')
            ->get();

        $eventArray = [];
        foreach ($events as $event) {
            $newArray = [];
        
            $newArray = [
                'id' => $event->key,
                'title' => $event->name,
                'start' => date('Y-m-d', strtotime($event->training_date)),
                'end' => date('Y-m-d', strtotime($event->end_date.'+1 day')),
                'color' => $event->color,
                'notificationCount' => $event->commentCount,
                'extendedProps' => [
                    'isTraining' => true
                ]
            ];
        
            $eventArray[] = $newArray;
        }

        $events2 = DB::table('events')
            ->leftJoin('users', 'events.trainer', '=', 'users.id')
            ->select('events.*', DB::raw('IF(events.trainer = 0, "#FE2C55", users.color) as color'))
            ->get();

        foreach ($events2 as $event) {
            $newArray = [];
        
            $newArray = [
                'id' => $event->key,
                'title' => $event->description,
                'start' => date('Y-m-d', strtotime($event->date)),
                'end' => date('Y-m-d', strtotime($event->date)),
                'color' => $event->color,
                'notificationCount' => 0,
                'extendedProps' => [
                    'isTraining' => false
                ]
            ];
        
            $eventArray[] = $newArray;
        }

        $role = Auth::user()->role;

        return view('user.index', compact('events', 'eventArray', 'trainers', 'requestCount', 'trainingCount', 'role'));
    }

    public function view(Request $request){
        $id = $request->id;
        $thisRequest = DB::table('requests')
            ->select('customers.name', 'customers.address', 'customers.area', 'customers.cp1_name', 'customers.cp1_number', 'customers.cp1_email', 'customers.cp2_name', 'customers.cp2_number', 'customers.cp2_email', 'customers.cp3_name', 'customers.cp3_number', 'customers.cp3_email', 'requests.number', 'requests.category', 'requests.unit_type', 'requests.brand', 'requests.model', 'requests.no_of_unit', 'requests.billing_type', 'requests.is_PM', 'requests.contract_details', 'requests.no_of_attendees', 'requests.venue', 'requests.training_date', 'requests.end_date', 'requests.knowledge_of_participants', 'requests.trainer', 'requests.remarks', 'requests.status', 'requests.key', 'users.first_name', 'users.last_name')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->join('users', 'requests.trainer', '=', 'users.id')
            ->where('requests.key', $id)
            ->first();
        
        $com = '';

        $comments = DB::table('comments')
            ->select('comments.key', DB::raw('MAX(comments.content) as content'), DB::raw('MAX(comments.created_at) as created_at'), DB::raw('MAX(users.first_name) as ufname'), DB::raw('MAX(users.last_name) as ulname'))
            ->join('users', 'comments.commenter_id', '=', 'users.key')
            ->where('comments.req_id', $request->id)
            ->groupBy('key')
            ->get();

        foreach ($comments as $comment) {
            $dateTimeObj = new DateTime($comment->created_at);
            $date = $dateTimeObj->format('F j, Y');
            $time = $dateTimeObj->format('h:i A');
            $com .= '
                <div class="my-2 border border-gray-400 shadow p-2 rounded-lg">
                    <div class="flex flex-col leading-4">
                        <h1 class="font-semibold">'.$comment->ufname.' '.$comment->ulname.'</h1>
                        <p class="text-sm mb-2">'.$date.' at '.$time.'</p>
                        <p>'.$comment->content.'</p>
                    </div>
                </div>
            ';
        }

        DB::table('comments')->where('req_id', $request->id)->where('user_id', Auth::user()->key)->update([
            'is_read' => 1
        ]);

        $result = array(
            'status' => $thisRequest->status,
            'event_date' => $thisRequest->training_date,
            'end_date' => $thisRequest->end_date,
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

            'com' => $com,
        );

        echo json_encode($result);
    }

    public function complete($key){
        DB::table('requests')->where('key', $key)->update([
            'status' => 'COMPLETED',
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Training Has Been Cancelled');
    }

    public function extend($key){
        DB::table('requests')->where('key', $key)->update([
            'end_date' => DB::raw("DATE_ADD(STR_TO_DATE(end_date, '%m/%d/%Y'), INTERVAL 1 DAY)")
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Training Has Been Succesfuly Extended.');
    }

    public function cancel($key){
        DB::table('requests')->where('key', $key)->update([
            'status' => 'CANCELLED',
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Training Has Been Cancelled');
    }
}
