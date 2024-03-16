<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WrittenExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WrittenExamController extends Controller
{
    public function index(Request $request){
        $questions = WrittenExam::get();

        return view('user.training-assessment.questions.index', compact('questions'));
    }

    public function add(){
        return view('user.training-assessment.questions.add');
    }

    public function store(Request $request){
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
        $answer = $request->answer;
        $points = $request->points;
        $firstOption = 0;

        $examQuestion = new WrittenExam();
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
        }
        $examQuestion->options = $options;
        $examQuestion->save();

        return redirect()->route('questions.index')->with('success', 'Question Has Been Added Successfully!');
    }
}
