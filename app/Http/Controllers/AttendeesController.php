<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendees;
use App\Models\Request as ModelsRequest;
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

        return view('user.training-assessment.index', compact('training', 'attendees', 'key'));
    }

    public function add(Request $request){
        $key = $request->key;
        $training = ModelsRequest::with('customer', 'trainerName')->where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }

        return view('user.training-assessment.add', compact('key'));
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
            'type' => 'required',
            'knowledge' => 'required',
            'years_operating' => 'required',
        ]);

        $customMessages = [
            'name.required' => 'Please provide the required information.',
            'position.required' => 'Please provide the required information.',
            'type.required' => 'Please select an option from the list.',
            'knowledge.required' => 'Please select an option from the list.',
            'years_operating.required' => 'Please provide the required information.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->name;
        $position = $request->position;
        $type = $request->type;
        $knowledge = $request->knowledge;
        $years_operating = $request->years_operating;

        $attendee = new Attendees();
        $attendee->training_key = $key;
        $attendee->name = $name;
        $attendee->position = $position;
        $attendee->type = $type;
        $attendee->knowledge = $knowledge;
        $attendee->years_operating = $years_operating;
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

        return view('user.training-assessment.edit', compact('key', 'attendee'));
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
            'type' => 'required',
            'knowledge' => 'required',
            'years_operating' => 'required',
        ]);

        $customMessages = [
            'name.required' => 'Please provide the required information.',
            'position.required' => 'Please provide the required information.',
            'type.required' => 'Please select an option from the list.',
            'knowledge.required' => 'Please select an option from the list.',
            'years_operating.required' => 'Please provide the required information.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $akey = $request->a;
        $name = $request->name;
        $position = $request->position;
        $type = $request->type;
        $knowledge = $request->knowledge;
        $years_operating = $request->years_operating;

        $attendee = Attendees::where('key', $akey)->first();
        $attendee->name = $name;
        $attendee->position = $position;
        $attendee->type = $type;
        $attendee->knowledge = $knowledge;
        $attendee->years_operating = $years_operating;
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

    public function writtenExam(Request $request){
        dd($request);
        $key = $request->key;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }
        $akey = $request->a;
        $attendee = Attendees::where('key', $akey)->first();
        
    }
}
