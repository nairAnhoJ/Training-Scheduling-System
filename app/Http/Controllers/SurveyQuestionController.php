<?php

namespace App\Http\Controllers;

use App\Models\SurveyQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveyQuestionController extends Controller
{
    public function index(Request $request){
        $questions = SurveyQuestion::where('is_deleted', 0)->get();

        return view('user.training-assessment.survey.index', compact('questions'));
    }

    public function add(Request $request){
        return view('user.training-assessment.survey.add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'question' => 'required'
        ]);

        $customMessages = [
            'type.required' => 'Please select an option from the list.',
            'question.required' => 'Please provide the required information.'
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = $request->type;
        $question = $request->question;
        $firstOption = 0;

        $surveyQuestion = new SurveyQuestion();
        $surveyQuestion->type = $type;
        $surveyQuestion->question = $question;
        if($type == 'MultipleChoice'){
            $options = '';
            for ($i=1; $i < 11; $i++) {
                $var = 'option'.$i;
                if($request->$var != null){
                    if($firstOption == 1){
                        $options .= ';'.$request->$var;
                    }else{
                        $options .= $request->$var;
                        $firstOption = 1;
                    }
                }
            }
            $surveyQuestion->options = strtolower($options);
        }
        $surveyQuestion->save();

        return redirect()->route('survey.index')->with('success', 'New Question Has Been Added Successfully!');
    }

    public function edit(Request $request){
        $question = SurveyQuestion::where('id', $request->id)->first();

        return view('user.training-assessment.survey.edit', compact('question'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'question' => 'required'
        ]);

        $customMessages = [
            'type.required' => 'Please select an option from the list.',
            'question.required' => 'Please provide the required information.'
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = $request->type;
        $question = $request->question;
        $firstOption = 0;

        $surveyQuestion = SurveyQuestion::where('id', $request->id)->first();
        $surveyQuestion->type = $type;
        $surveyQuestion->question = $question;
        if($type == 'MultipleChoice'){
            $options = '';
            for ($i=1; $i < 11; $i++) {
                $var = 'option'.$i;
                if($request->$var != null){
                    if($firstOption == 1){
                        $options .= ';'.$request->$var;
                    }else{
                        $options .= $request->$var;
                        $firstOption = 1;
                    }
                }
            }
            $surveyQuestion->options = strtolower($options);
        }
        $surveyQuestion->save();

        return redirect()->route('survey.index')->with('success', 'New Question Has Been Updated Successfully!');
    }

    public function delete(Request $request){
        $weq = SurveyQuestion::where('id', $request->id)->first();
        $weq->is_deleted = 1;
        $weq->save();

        return redirect()->route('survey.index')->with('success', 'Question Has Been Deleted Successfully!');
    }
}
