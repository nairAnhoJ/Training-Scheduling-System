<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendees;
use App\Models\DrivingExam;
use App\Models\DrivingExamScore;
use App\Models\Request as ModelsRequest;
use App\Models\WrittenExam;
use App\Models\WrittenExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AttendeesController extends Controller
{
    public function index(Request $request){
        $key = $request->key;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }

        $attendees = Attendees::where('training_key', $key)->get();

        return view('user.training-assessment.attendees.index', compact('training', 'attendees', 'key'));
    }

    public function add(Request $request){
        $key = $request->key;
        $training = ModelsRequest::with('customer', 'trainerName')->where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }

        $wexams = WrittenExam::get();
        $dexams = DrivingExam::get();

        return view('user.training-assessment.attendees.add', compact('key', 'wexams', 'dexams'));
    }

    public function store(Request $request){
        $key = $request->key;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'knowledge' => 'required',
            'years_operating' => 'required',
            'written_exam' => 'required',
            'driving_exam' => 'required',
        ]);

        $customMessages = [
            'name.required' => 'Please provide the required information.',
            'position.required' => 'Please provide the required information.',
            'brand.required' => 'Please select an option from the list.',
            'type.required' => 'Please select an option from the list.',
            'knowledge.required' => 'Please select an option from the list.',
            'years_operating.required' => 'Please provide the required information.',
            'written_exam.required' => 'Please select an option from the list.',
            'driving_exam.required' => 'Please select an option from the list.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->name;
        $position = $request->position;
        $brand = $request->brand;
        $type = $request->type;
        $knowledge = $request->knowledge;
        $years_operating = $request->years_operating;
        $written_exam = $request->written_exam;
        $driving_exam = $request->driving_exam;


        $attendee = new Attendees();
        $attendee->training_key = $key;
        $attendee->name = $name;
        $attendee->position = $position;
        $attendee->brand = $brand;
        $attendee->type = $type;
        $attendee->knowledge = $knowledge;
        $attendee->years_operating = $years_operating;
        $attendee->written_exam = $written_exam;
        $attendee->driving_exam = $driving_exam;
        $attendee->key = Str::uuid()->toString();
        $attendee->save();

        return redirect()->route('attendees', ['key' => $key])->with('success', 'New Attendees Has Been Added Successfully!');
    }

    public function edit(Request $request){
        $key = $request->key;
        $akey = $request->a;
        $training = ModelsRequest::with('customer', 'trainerName')->where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }
        $attendee = Attendees::where('key', $akey)->first();
        $wexams = WrittenExam::get();
        $dexams = DrivingExam::get();

        return view('user.training-assessment.attendees.edit', compact('key', 'attendee', 'wexams', 'dexams'));
    }

    public function update(Request $request){
        $key = $request->key;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'knowledge' => 'required',
            'years_operating' => 'required',
            'written_exam' => 'required',
            'driving_exam' => 'required',
        ]);

        $customMessages = [
            'name.required' => 'Please provide the required information.',
            'position.required' => 'Please provide the required information.',
            'brand.required' => 'Please select an option from the list.',
            'type.required' => 'Please select an option from the list.',
            'knowledge.required' => 'Please select an option from the list.',
            'years_operating.required' => 'Please provide the required information.',
            'written_exam.required' => 'Please select an option from the list.',
            'driving_exam.required' => 'Please select an option from the list.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $akey = $request->a;
        $name = $request->name;
        $position = $request->position;
        $brand = $request->brand;
        $type = $request->type;
        $knowledge = $request->knowledge;
        $years_operating = $request->years_operating;
        $written_exam = $request->written_exam;
        $driving_exam = $request->driving_exam;

        $attendee = Attendees::where('key', $akey)->first();
        $attendee->name = $name;
        $attendee->position = $position;
        $attendee->brand = $brand;
        $attendee->type = $type;
        $attendee->knowledge = $knowledge;
        $attendee->years_operating = $years_operating;
        $attendee->written_exam = $written_exam;
        $attendee->driving_exam = $driving_exam;
        $attendee->save();

        return redirect()->route('attendees', ['key' => $key])->with('success', 'Attendee Has Been Updated Successfully!');
    }

    public function delete(Request $request){
        $key = $request->key;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }
        Attendees::where('id', $request->id)->delete();

        return redirect()->route('attendees', ['key' => $key])->with('success', 'Attendee Has Been Deleted Successfully!');
    }

    public function generate(Request $request){
        echo QrCode::size(250)->generate('http://192.168.20.143:8000/training-assessment/written-exam?key='.$request->key.'&a='.$request->akey);
    }

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

        return view('user.training-assessment.attendees.driving.grading.index', compact('key', 'attendee', 'dexams', 'driving_score'));
    }

    public function drivingExamSubmit(Request $request){
        $key = $request->key;
        $akey = $request->a;
        $training = ModelsRequest::with('customer', 'trainerName')->where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }

        $validator = Validator::make($request->all(), [
            'seatbelt' => 'required',
            'contact' => 'required',
            'horns' => 'required',
            'skid' => 'required',
            'controls' => 'required',
            'handling' => 'required',
            'behavior' => 'required',
            'time' => 'required',
        ]);

        $customMessages = [
            'seatbelt.required' => 'Please provide the required information.',
            'contact.required' => 'Please provide the required information.',
            'horns.required' => 'Please provide the required information.',
            'skid.required' => 'Please provide the required information.',
            'controls.required' => 'Please provide the required information.',
            'handling.required' => 'Please provide the required information.',
            'behavior.required' => 'Please provide the required information.',
            'time.required' => 'Please provide the required information.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $attendee = Attendees::where('key', $akey)->first();
        $dexams = DrivingExam::where('id', $attendee->driving_exam)->first();

        $seatbelt = $request->seatbelt;
        $contact = $request->contact;
        $horns = $request->horns;
        $skid = $request->skid;

        $controls = $request->controls;
        $handling = $request->handling;
        $behavior = $request->behavior;
        $time = $request->time;

        $score = new DrivingExamScore();
        $score->training_key = $key;
        $score->attendee_key = $akey;
        $score->exam_key = $dexams->key;
    
        $score->seatbelt = $seatbelt;
        $score->contact = $contact;
        $score->horns = $horns;
        $score->skid = $skid;
        $score->controls = $controls;
        $score->handling = $handling;
        $score->behavior = $behavior;
        $score->time = $time;
        $score->save();

        $total = $seatbelt + $contact + $horns + $skid + $controls + $handling + $behavior + $time;

        $attendee->driving_score = $total;
        $attendee->save();

        return redirect()->route('driving.exam', ['key' => $key, 'a' => $akey])->with('success', 'Exam Score Has Been Submitted Successfully!');
    }

    public function overallResult(Request $request){
        $key = $request->key;
        $akey = $request->a;
        $training = ModelsRequest::with('customer', 'trainerName')->where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }

        $attendee = Attendees::where('key', $akey)->first();
        $exam_key = WrittenExam::where('id', $attendee->written_exam)->first()->key;
        $exam_total = WrittenExamQuestion::where('exam_key', $exam_key)->where('is_deleted', 0)->sum('points');

        return view('user.training-assessment.attendees.overall-result.index', compact('key', 'akey', 'attendee', 'exam_total'));
    }

    public function print(Request $request){
        $key = $request->key;
        $akey = $request->a;
        $training = ModelsRequest::with('customer', 'trainerName')->where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }

        $attendee = Attendees::where('key', $akey)->first();
        $exam_key = WrittenExam::where('id', $attendee->written_exam)->first()->key;
        $exam_total = WrittenExamQuestion::where('exam_key', $exam_key)->where('is_deleted', 0)->sum('points');

        return view('user.training-assessment.attendees.print-certificate', compact('key', 'akey', 'training', 'attendee', 'exam_total'));
    }

    public function updateCtrl(Request $request){
        $key = $request->ctrlKey;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }
        
        $akey = $request->ctrlaKey;
        $ctrl = $request->ctrl;
        $date = $request->date;

        $attendee = Attendees::where('key', $akey)->first();
        $attendee->control_number = $ctrl;
        $attendee->date_given = $date;
        $attendee->save();
    }
}