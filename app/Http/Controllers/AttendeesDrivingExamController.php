<?php

namespace App\Http\Controllers;
use App\Models\Attendees;
use App\Models\DrivingExam;
use App\Models\DrivingExamScore;
use App\Models\Request as ModelsRequest;

use Illuminate\Http\Request;

class AttendeesDrivingExamController extends Controller
{
    public function drivingExam(Request $request){
        $key = $request->key;
        $akey = $request->a;
        $training = ModelsRequest::with('customer', 'trainerName')->where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }
        $attendee = Attendees::where('key', $akey)->first();
        $dexams = DrivingExam::where('id', $attendee->driving_exam)->first();

        $driving_score = DrivingExamScore::where('training_key', $key)->where('attendee_key', $akey)->where('exam_key', $dexams->key)->first();

        return view('user.training-assessment.attendees.driving.index', compact('key', 'akey', 'training', 'attendee', 'dexams', 'driving_score'));
    }
}
