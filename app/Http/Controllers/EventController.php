<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Request as ModelsRequest;
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
            $existingModel = ModelsRequest::where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }
        
        Event::insert([
            'description' => $description,
            'date' => $date,
            'trainer' => $trainer,
            'key' => $key,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'New Event Successfully Added');
    }

    public function view(Request $request){
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

    public function delete($key){
        Event::where('key', $key)->delete();
        return redirect()->route('dashboard.index')->with('success', 'Event Successfully Deleted');
    }
}
