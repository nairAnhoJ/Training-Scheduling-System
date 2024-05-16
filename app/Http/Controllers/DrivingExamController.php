<?php

namespace App\Http\Controllers;

use App\Models\DrivingExam;
use App\Models\DrivingExamLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DrivingExamController extends Controller
{
    public function index(Request $request){
        $exams = DrivingExam::where('is_deleted', 0)->get();

        return view('user.training-assessment.exam.driving.index', compact('exams'));
    }


    public function add(){
        return view('user.training-assessment.exam.driving.add');
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'duration' => 'required',
        ]);

        $customMessages = [
            'name.required' => 'Please provide the required information.',
            'duration.required' => 'Please provide the required information.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->name;
        $duration = $request->duration;

        $exam = new DrivingExam();
        $exam->name = $name;
        $exam->duration = $duration;
        $exam->key = Str::uuid()->toString();
        $exam->save();

        return redirect()->route('driving.index')->with('success', 'New Driving Exam Has Been Added Successfully!');
    }


    public function edit(Request $request){
        $exam = DrivingExam::where('key', $request->exam)->first();

        return view('user.training-assessment.exam.driving.edit', compact('exam'));
    }


    public function update(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'duration' => 'required',
        ]);

        $customMessages = [
            'name.required' => 'Please provide the required information.',
            'duration.required' => 'Please provide the required information.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->name;
        $duration = $request->duration;

        $exam = DrivingExam::where('key', $request->key)->first();
        $exam->name = $name;
        $exam->duration = $duration;
        $exam->save();

        return redirect()->route('driving.index')->with('success', 'Driving Exam Has Been Updated Successfully!');
    }
    

    public function delete(Request $request){
        $drivingExam = DrivingExam::where('key', $request->key)->first();
        $drivingExam->is_deleted = 1;
        $drivingExam->save();
        // DrivingExamLayout::where('exam_key', $request->key)->delete();

        return redirect()->route('driving.index')->with('success', 'Driving Exam Has Been Deleted Successfully!');
    }
}
