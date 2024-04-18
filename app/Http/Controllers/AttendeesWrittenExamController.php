<?php

namespace App\Http\Controllers;

use App\Models\Attendees;
use App\Models\Request as ModelsRequest;
use App\Models\WrittenExam;
use Illuminate\Http\Request;

class AttendeesWrittenExamController extends Controller
{
    public function writtenExam(Request $request){
        $key = $request->key;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }
        $akey = $request->a;
        $attendee = Attendees::where('key', $akey)->first();
        $exam  = WrittenExam::find($attendee->written_exam);

        return view('user.training-assessment.attendees.exam.index', compact('attendee', 'key', 'akey', 'exam'));
    }

    public function npQuestion(Request $request){
        dd($request);
    }
}
