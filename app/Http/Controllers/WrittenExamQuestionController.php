<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WrittenExam;
use App\Models\WrittenExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WrittenExamQuestionController extends Controller
{
    public function index(Request $request){
        $key = $request->key;
        $exam = WrittenExam::where('key', $key)->first();
        if($exam == null){
            return redirect()->route('exam.index');
        }

        $questions = WrittenExamQuestion::where('exam_key', $key)->get();

        return view('user.training-assessment.exam.written.questions.index', compact('questions', 'key'));
    }

    public function add(Request $request){
        $key = $request->key;
        $exam = WrittenExam::where('key', $key)->first();
        if($exam == null){
            return redirect()->route('exam.index');
        }

        return view('user.training-assessment.exam.written.questions.add', compact('key'));
    }

    public function store(Request $request){
        $key = $request->key;
        $exam = WrittenExam::where('key', $key)->first();
        if($exam == null){
            return redirect()->route('exam.index');
        }

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'points' => 'required',
        ]);

        $customMessages = [
            'type.required' => 'Please select an option from the list.',
            'question.required' => 'Please provide the required information.',
            'answer.required' => 'Please provide the required information.',
            'points.required' => 'Please provide the required information.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = $request->type;
        $question = $request->question;
        $answer = strtolower($request->answer);
        $points = $request->points;
        $firstOption = 0;

        $examQuestion = new WrittenExamQuestion();
        $examQuestion->exam_key = $key;
        $examQuestion->type = $type;
        $examQuestion->question = $question;
        $examQuestion->answer = $answer;
        $examQuestion->points = $points;
        if($type == 'MultipleChoice'){
            $options = '';
            for ($i=1; $i < 11; $i++) {
                $var = 'option'.$i;
                if($request->$var != null){
                    if($firstOption == 1){
                        $options .= ','.$request->$var;
                    }else{
                        $options .= $request->$var;
                        $firstOption = 1;
                    }
                }
            }
            $examQuestion->options = $options;
        }
        $examQuestion->save();

        return redirect()->route('question.index', ['key' => $key])->with('success', 'New Question Has Been Added Successfully!');
    }

    public function edit(Request $request){
        $key = $request->key;
        $exam = WrittenExam::where('key', $key)->first();
        if($exam == null){
            return redirect()->route('exam.index');
        }
        $question = WrittenExamQuestion::where('id', $request->question)->first();

        return view('user.training-assessment.exam.written.questions.edit', compact('key', 'question'));
    }

    public function update(Request $request){
        $key = $request->key;
        $exam = WrittenExam::where('key', $key)->first();
        if($exam == null){
            return redirect()->route('exam.index');
        }

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'points' => 'required',
        ]);

        $customMessages = [
            'type.required' => 'Please select an option from the list.',
            'question.required' => 'Please provide the required information.',
            'answer.required' => 'Please provide the required information.',
            'points.required' => 'Please provide the required information.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = $request->type;
        $question = $request->question;
        $answer = strtolower($request->answer);
        $points = $request->points;
        $firstOption = 0;

        $examQuestion = WrittenExamQuestion::where('id', $request->qid)->first();
        $examQuestion->type = $type;
        $examQuestion->question = $question;
        $examQuestion->answer = $answer;
        $examQuestion->points = $points;
        if($type == 'MultipleChoice'){
            $options = '';
            for ($i=1; $i < 11; $i++) {
                $var = 'option'.$i;
                if($request->$var != null){
                    if($firstOption == 1){
                        $options .= ','.$request->$var;
                    }else{
                        $options .= $request->$var;
                        $firstOption = 1;
                    }
                }
            }
            $examQuestion->options = $options;
        }
        $examQuestion->save();

        return redirect()->route('question.index', ['key' => $key])->with('success', 'Question Has Been Updated Successfully!');
    }
}
