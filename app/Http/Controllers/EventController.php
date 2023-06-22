<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function add(Request $request){
        $description = $request->description;
        $date = $request->date;
        $trainer = $request->trainer;

        $unique = false;
        $key = null;

        while (!$unique) {
            $key = Str::uuid()->toString();
            $existingModel = DB::table('requests')->where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }
        
        DB::table('events')->insert([
            'description' => $description,
            'date' => $date,
            'trainer' => $trainer,
            'key' => $key,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'New Event Successfully Added');
    }

    public function view(Request $request){
        $id = $request->id;

        $event = DB::table('events')
            ->leftJoin('users', 'events.trainer', '=', 'users.id')
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

    public function delete($key){
        DB::table('events')->where('key', $key)->delete();
        return redirect()->route('dashboard.index')->with('success', 'Event Successfully Deleted');
    }
}
