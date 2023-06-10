<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $events = DB::table('requests')
            ->select('customers.name', 'requests.category', 'requests.unit_type', 'requests.billing_type', 'customers.area', 'requests.trainer', 'requests.updated_at', 'requests.key', 'requests.training_date', 'requests.id', 'users.id as uid', 'users.first_name', 'users.last_name', 'users.color')
            ->join('customers', 'requests.customer_id', '=', 'customers.id')
            ->join('users', 'requests.trainer', '=', 'users.id')
            ->where('is_approved', 1)
            ->get();

        $eventArray = [];
        foreach ($events as $event) {
            // Create a new array for each iteration
            $newArray = [];
        
            // Populate the new array with desired values
            $newArray = [
                'id' => $event->id,
                'title' => $event->name,
                'start' => date('Y-m-d', strtotime($event->training_date)),
                'color' => $event->color,
            ];
        
            // Push the new array into the result array
            $eventArray[] = $newArray;
        }

        return view('admin.index', compact('events', 'eventArray'));
    }
}
