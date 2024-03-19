<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WrittenExam;
use App\Models\WrittenExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WrittenExamController extends Controller
{
    public function index(Request $request){
        $exams = WrittenExam::get();

        return view('user.training-assessment.exam.written.index', compact('exams'));
    }

    public function add(){
        return view('user.training-assessment.exam.written.add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $customMessages = [
            'name.required' => 'Please provide the required information.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->name;

        $exam = new WrittenExam();
        $exam->name = $name;
        $exam->key = Str::uuid()->toString();
        $exam->save();

        return redirect()->route('exam.index')->with('success', 'New Exam Has Been Added Successfully!');
    }

    public function edit(Request $request){
        $exam = WrittenExam::where('key', $request->exam)->first();

        return view('user.training-assessment.exam.written.edit', compact('exam'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $customMessages = [
            'name.required' => 'Please provide the required information.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->name;

        $exam = WrittenExam::where('key', $request->key)->first();
        $exam->name = $name;
        $exam->save();

        return redirect()->route('exam.index')->with('success', 'Exam Title Has Been Updated Successfully!');
    }

    public function delete(Request $request){
        WrittenExam::where('key', $request->key)->delete();
        WrittenExamQuestion::where('exam_key', $request->key)->delete();

        return redirect()->route('exam.index')->with('success', 'Exam Has Been Deleted Successfully!');
    }
}
