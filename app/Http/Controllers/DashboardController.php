<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Request as ModelsRequest;
use App\Models\User;
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

        $requestCount = ModelsRequest::where('is_approved', 0)->where('is_deleted', 0)->where('status', 'PENDING')->count();
        $trainingCount = ModelsRequest::where('is_approved', 1)->where('is_deleted', 0)->where('status', 'SCHEDULED')->count();

        $trainers = User::where('role', 2)->where('is_active', 1)->get();

        $events = ModelsRequest::with('customer', 'trainerName', 'comments')
            ->withCount(['comments' => function ($query) {
                $query->where('is_read', 0)->where('user_id', Auth::user()->key);
            }])
            ->where(function ($query) {
                $query->where('plan_start_date', '!=', null)
                      ->orWhereIn('status', ['SCHEDULED', 'COMPLETED']);
            })
            ->where('trainer', '!=', null)
            ->paginate(10);

        // dd($events);

        $eventArray = [];
        foreach ($events as $event) {
            $newArray = [];

            if($event->is_approved == 1){
                $newArray = [
                    'id' => $event->key,
                    'title' => '🟢'.$event->customer->name,
                    'start' => date('Y-m-d', strtotime($event->training_date)),
                    'end' => date('Y-m-d', strtotime($event->end_date.'+1 day')),
                    'color' => $event->color,
                    'notificationCount' => $event->comments_count,
                    'extendedProps' => [
                        'isTraining' => true
                    ]
                ];
            }else{
                if($event->plan_start_date != null){
                    $newArray = [
                        'id' => $event->key,
                        'title' => '🟠'.$event->customer->name,
                        'start' => date('Y-m-d', strtotime($event->plan_start_date)),
                        'end' => date('Y-m-d', strtotime($event->plan_end_date.'+1 day')),
                        'color' => $event->color,
                        'notificationCount' => $event->comments_count,
                        'extendedProps' => [
                            'isTraining' => true
                        ]
                    ];
                }
            }

            $eventArray[] = $newArray;
        }

        $events2 = Event::leftJoin('tss_users', 'tss_events.trainer', '=', 'tss_users.id')
            ->select('tss_events.*', DB::raw('IF(tss_events.trainer = 0, "#FE2C55", tss_users.color) as color'))
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
        $thisRequest = ModelsRequest::select('customers.name', 'customers.address', 'customers.area', 'customers.cp1_name', 'customers.cp1_number', 'customers.cp1_email', 'customers.cp2_name', 'customers.cp2_number', 'customers.cp2_email', 'customers.cp3_name', 'customers.cp3_number', 'customers.cp3_email', 'tss_requests.number', 'tss_requests.category', 'tss_requests.unit_type', 'tss_requests.brand', 'tss_requests.model', 'tss_requests.no_of_unit', 'tss_requests.billing_type', 'tss_requests.is_PM', 'tss_requests.contract_details', 'tss_requests.no_of_attendees', 'tss_requests.venue', 'tss_requests.training_date', 'tss_requests.end_date', 'tss_requests.knowledge_of_participants', 'tss_requests.trainer', 'tss_requests.remarks', 'tss_requests.status', 'tss_requests.key', 'tss_users.first_name', 'tss_users.last_name')
            ->join('customers', 'tss_requests.customer_id', '=', 'customers.id')
            ->join('tss_users', 'tss_requests.trainer', '=', 'tss_users.id')
            ->where('tss_requests.key', $id)
            ->first();

        
        $com = '';

        // $comments = Comment::select('tss_comments.key', DB::raw('MAX(tss_comments.content) as content'), DB::raw('MAX(tss_comments.created_at) as created_at'), DB::raw('MAX(tss_users.first_name) as ufname'), DB::raw('MAX(tss_users.last_name) as ulname'))
        //     ->join('tss_users', 'tss_comments.commenter_id', '=', 'tss_users.key')
        //     ->where('tss_comments.req_id', $request->id)
        //     ->groupBy('key')
        //     ->get();

        $comments = Comment::with('user')->where('req_id', $request->id)->where('user_id', Auth::user()->key)->get();

        foreach ($comments as $comment) {
            $com .= '
                <div class="p-2 my-2 border border-gray-400 rounded-lg shadow">
                    <div class="flex flex-col leading-4">
                        <h1 class="font-semibold">'.$comment->user->first_name.' '.$comment->user->last_name.'</h1>
                        <p class="mb-2 text-xs">'.date('F j, Y h:i A', strtotime($comment->created_at)).'</p>
                        <p>'.$comment->content.'</p>
                    </div>
                </div>
            ';
        }

        if($com != ''){
            Comment::where('req_id', $request->id)->where('user_id', Auth::user()->key)->update([
                'is_read' => 1
            ]);
        }

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

            'com' => $com,
        );

        echo json_encode($result);
    }

    public function complete($key){
        ModelsRequest::where('key', $key)->update([
            'status' => 'COMPLETED',
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Training Has Been Cancelled');
    }

    public function extend($key){
        ModelsRequest::where('key', $key)->update([
            'end_date' => DB::raw("DATE_ADD(STR_TO_DATE(end_date, '%m/%d/%Y'), INTERVAL 1 DAY)")
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Training Has Been Succesfuly Extended.');
    }

    public function cancel($key){
        ModelsRequest::where('key', $key)->update([
            'status' => 'CANCELLED',
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Training Has Been Cancelled');
    }
}
