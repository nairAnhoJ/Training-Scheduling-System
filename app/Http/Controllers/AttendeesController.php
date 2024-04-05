<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendees;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AttendeesController extends Controller
{
    public function index(Request $request){
        $key = $request->key;
        $training = ModelsRequest::with('customer', 'trainerName')->where('key', $key)->first();
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
        $training = ModelsRequest::with('customer', 'trainerName')->where('key', $key)->first();
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

        $exam = new Attendees();
        $exam->training_key = $key;
        $exam->name = $name;
        $exam->position = $position;
        $exam->type = $type;
        $exam->knowledge = $knowledge;
        $exam->years_operating = $years_operating;
        $exam->key = Str::uuid()->toString();
        $exam->save();

        return redirect()->route('attendees', ['key' => $key])->with('success', 'New Attendees Has Been Added Successfully!');
    }
}
