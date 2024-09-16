<?php

namespace App\Http\Controllers;

use App\Models\Attendees;
use App\Models\AttendeesSurveyAnswers;
use App\Models\AttendeesWrittenExamAnswers;
use App\Models\Request as ModelsRequest;
use App\Models\Setting;
use App\Models\SurveyQuestion;
use App\Models\WrittenExam;
use App\Models\WrittenExamQuestion;
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
        $total = 0;
        foreach($exam->questions as $eq){
            $total = $total + $eq->points;
        }
        $questionSequence = WrittenExamQuestion::where('exam_key', $exam->key)->pluck('id')->toArray();
        shuffle($questionSequence);

        return view('user.training-assessment.attendees.exam.index', compact('attendee', 'key', 'akey', 'exam', 'total', 'questionSequence'));
    }

    public function npQuestion(Request $request){
        $key = $request->key;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }
        $akey = $request->akey;
        $attendee = Attendees::where('key', $akey)->first();
        $exam  = WrittenExam::find($attendee->written_exam);
        $nob = $request->nob;
        $q = $request->q;
        $content = '';
        if(is_array($request->answer)){
            $answer = array_map('strtolower', $request->answer);
        }else{
            $answer = array_map('strtolower', explode(';', $request->answer));
        }
        $questionSequence = $request->questionSequence;

        if($attendee->written_exam_start == null){
            $attendee->written_exam_start = date('Y-m-d H:i:s');
            $attendee->save();
        }

        $previousQuestionID = ($q != -1) ? $questionSequence[$q] : null;

        $nextQuestionID = null;
        if($nob == 'NEXT'){
            $nextQuestionID = $questionSequence[$q+1];
        }else if($nob == 'BACK'){
            $nextQuestionID = $questionSequence[$q-1];
        }

        $previousQuestion = ($previousQuestionID != null) ? WrittenExamQuestion::where('id', $previousQuestionID)->first() : null;
        $previousAnswer = ($previousQuestionID != null) ? AttendeesWrittenExamAnswers::where('training_key', $key)->where('attendee_key', $akey)->where('question_id', $previousQuestion->id)->first() : null;

        $nextQuestion = ($nextQuestionID != null) ? WrittenExamQuestion::where('id', $nextQuestionID)->first() : null;
        $nextAnswerRow = ($nextQuestionID != null) ? AttendeesWrittenExamAnswers::where('training_key', $key)->where('attendee_key', $akey)->where('question_id', $nextQuestion->id)->first() : null;

        $nextAnswer = ($nextAnswerRow != null) ? array_map('strtolower', explode(';', $nextAnswerRow->answer)) : [];

        $previousQuestionAnswers = ($previousQuestion != null) ? array_map('strtolower', explode(';', $previousQuestion->answer)) : null;
        $points = ($previousQuestion != null) ? count(array_intersect($previousQuestionAnswers, $answer)) : 0;

        if($nob == 'SUBMIT'){

            if($previousQuestion != null){
                if($previousAnswer == null){
                    $newAnswer = new AttendeesWrittenExamAnswers();
                    $newAnswer->training_key = $key;
                    $newAnswer->attendee_key = $akey;
                    $newAnswer->exam_key = $exam->key;
                    $newAnswer->question_id = $previousQuestion->id;
                    $newAnswer->answer = implode(';', $answer);
                    $newAnswer->points = $points;
                    $newAnswer->save();
                }else{
                    $previousAnswer->answer = implode(';', $answer);
                    $previousAnswer->points = $points;
                    $previousAnswer->save();
                }
            }
            

            $examResult = AttendeesWrittenExamAnswers::where('training_key', $key)->where('attendee_key', $akey)->sum('points');
            $attendee->written_score = $examResult;

            if($attendee->driving_score != null){
                $settings = Setting::where('id', 1)->first();
                $attendee->control_number = $settings->control_number;
                $settings->control_number = $settings->control_number + 1;
                $settings->save();
            }

            $attendee->save();

            $content = '
                            <div class="h-full flex items-center flex-col justify-between">
                                <div class="font-bold text-4xl tracking-wider text-center mt-5">'.$exam->name.'</div>

                                <div class="font-bold text-6xl bg-neutral-800 aspect-square rounded-full w-full text-white relative max-w-[275px]">
                                    <p class="absolute top-1/2 left-1/2 -translate-x-full -translate-y-full pr-2">'.$examResult.'</p>
                                    <p class=" text-9xl absolute top-1/2 font-medium left-1/2 -translate-x-1/2 -translate-y-1/2">/</p>
                                    <p class="absolute top-1/2 left-1/2 pl-2">'.$exam->questions->count().'</p>
                                </div>

                                <div class="font-bold text-2xl tracking-wider text-center mb-5">'.$attendee->name.'</div>
                            </div>
                        ';
        }else{
            if($q == 0 && $nob == 'BACK'){
                $content = '
                    <div id="main" class="h-full grid grid-cols-1 sm:grid-cols-1 grid-rows-3 text-center">
                        <div class="self-center">
                            <p class="font-bold tracking-wide uppercase text-2xl">'.$exam->name.'</p>
                        </div>
                        <div class="self-end">
                            <p class="font-bold tracking-wide text-xl">'.$attendee->name.'</p>
                        </div>
                        <div class="self-end">
                            <p class="text-sm">Click "START" to start the exam.</p>
                        </div>
                    </div>
                ';
            }else{
                if($nextQuestion->type == 'MultipleChoice' || $nextQuestion->type == 'TrueOrFalse'){
                    $options = ['true', 'false'];
                    if($nextQuestion->type == 'MultipleChoice'){
                        $options = explode(';', $nextQuestion->options);
                        shuffle($options);
                    }
        
                    $theOptions = '';
                    foreach($options as $index => $option){
                        $theOptions .= '
                            <div class="flex items-center rounded-xl justify-between pl-1 pr-2 py-3 '.((in_array($option, $nextAnswer)) ? 'border-2 border-blue-400' : 'border border-neutral-100').' shadow optionDiv hover:cursor-pointer">
                                <label for="option'.$index.'" class="ms-2 text-sm font-medium text-gray-900">'.ucfirst($option).'</label>
                                <input '.((in_array($option, $nextAnswer)) ? 'checked' : '').' id="option'.$index.'" type="radio" value="'.$option.'" name="answer" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 inputRadio">
                            </div>
                        ';
                    }
        
                    $content = '
                        <div class="h-full">
                            <input type="hidden" value="multiplechoice" id="qtype">
                            <p class="text-lg font-bold mb-10">'.$nextQuestion->question.'</p>
                            <div class="flex flex-col gap-y-3">
                                '.$theOptions.'
                            </div>
                        </div>
                    ';
                }else if($nextQuestion->type == 'MultipleSelect'){
                    
                    $options = explode(';', $nextQuestion->options);
                    shuffle($options);
        
                    $theOptions = '';
                    foreach($options as $index => $option){
                        $theOptions .= '
                            <div class="flex items-center rounded-xl justify-between pl-1 pr-2 py-3 '.((in_array($option, $nextAnswer)) ? 'border-2 border-blue-400' : 'border border-neutral-100').' shadow selectOptionDiv hover:cursor-pointer">
                                <label for="option'.$index.'" class="ms-2 text-sm font-medium text-gray-900">'.ucfirst($option).'</label>
                                <input '.((in_array($option, $nextAnswer)) ? 'checked' : '').' id="option'.$index.'" type="checkbox" value="'.$option.'" name="answer[]" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 inputRadio">
                            </div>
                        ';
                    }
        
                    $content = '
                        <div class="h-full">
                            <input type="hidden" value="multipleselect" id="qtype">
                            <p class="text-lg font-bold mb-10">'.$nextQuestion->question.'</p>
                            <div class="flex flex-col gap-y-3">
                                '.$theOptions.'
                            </div>
                        </div>
                    ';
                }else if($nextQuestion->type == 'ShortAnswer' || $nextQuestion->type == 'Enumeration'){

                    $theAnswers = '';
                    if($nextQuestion->type == 'ShortAnswer'){
                        $theAnswers .= '
                            <div class="w-full flex items-center gap-x-2">
                                <input type="text" id="answer" name="answer" value="'.$nextAnswer[0].'" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                            </div>
                        ';
                    }else if($nextQuestion->type == 'Enumeration'){
                        for ($i=0; $i < $nextQuestion->points; $i++) {
                            $theAnswers .= '
                                <div class="w-full flex items-center gap-x-2">
                                    <p class="w-7">'.($i+1).'. </p>
                                    <input type="text" id="answer'.$i.'" name="answer[]" value="'.$nextAnswer[$i].'" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                                </div>
                            ';
                        }
                    }
                    

                    if($nextQuestion->type == 'ShortAnswer'){
                        $content = '
                                        <div class="h-full">
                                            <input type="hidden" value="shortanswer" id="qtype">
                                            <p class="text-lg font-bold mb-10">'.$nextQuestion->question.'</p>
                                            <div class="flex flex-col gap-y-3">
                                                '.$theAnswers.'
                                            </div>
                                        </div>
                                    ';
                    }else{
                        $content = '
                                        <div class="h-full">
                                        <input type="hidden" value="enumeration" id="qtype">
                                        <p class="text-base mb-2 font-bold">Enumeration</p>
                                            <p class="text-lg font-bold mb-10">'.$nextQuestion->question.' ('.$nextQuestion->points.' points)</p>
                                            <div class="flex flex-col gap-y-3">
                                                '.$theAnswers.'
                                            </div>
                                        </div>
                                    ';
                    }
                }


                if($nob == 'BACK' || (($q != -1) && ($nob == 'NEXT'))){
                    if($answer != null){
                        // dd($answer);
                        if($previousAnswer == null){
                            $newAnswer = new AttendeesWrittenExamAnswers();
                            $newAnswer->training_key = $key;
                            $newAnswer->attendee_key = $akey;
                            $newAnswer->exam_key = $exam->key;
                            $newAnswer->question_id = $previousQuestion->id;
                            $newAnswer->answer = implode(';', $answer);
                            $newAnswer->points = $points;
                            $newAnswer->save();
                        }else{
                            $previousAnswer->answer = implode(';', $answer);
                            $previousAnswer->points = $points;
                            $previousAnswer->save();
                        }
                    }
                }
            }
        }
        
        echo $content;
    }

    public function resultSummary(Request $request){
        $key = $request->key;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }
        $akey = $request->akey;
        $attendee = Attendees::where('key', $akey)->first();
        $exam  = WrittenExam::find($attendee->written_exam);
        $questions = WrittenExamQuestion::where('exam_key', $exam->key)->orderBy('id')->get();
        $allAnswers = AttendeesWrittenExamAnswers::where('training_key', $key)->where('attendee_key', $akey)->get();
        $summary = '';

        foreach($questions as $index => $question){

            if($index > 0){
                $summary .= '
                    <div class="flex items-center justify-center w-full">
                        <hr class="bg-neutral-500 w-32">
                    </div>
                ';
            }

            if($question->type == 'MultipleChoice' || $question->type == 'TrueOrFalse' || $question->type == 'ShortAnswer'){
                if(strtolower($question->answer) == strtolower($allAnswers[$index]->answer)){
                    $summary .= '
                        <div class="w-full">
                            <p class="text-base font-medium mb-1 leading-5">'.($index+1).'. '.$question->question.'</p>
                            <p class="text-base font-semibold w-full leading-5">
                                <span>Answer:</span> 
                                <span class="text-emerald-600">
                                    '.$allAnswers[$index]->answer.'
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-5 h-5 inline" fill="currentColor">
                                        <path xmlns="http://www.w3.org/2000/svg" d="m421-276 297-297-83-84-214 214-102-102-83 84 185 185Zm59 230q-91 0-169.99-34.08-78.98-34.09-137.41-92.52-58.43-58.43-92.52-137.41Q46-389 46-480q0-91 34.08-169.99 34.09-78.98 92.52-137.41 58.43-58.43 137.41-92.52Q389-914 480-914q91 0 169.99 34.08 78.98 34.09 137.41 92.52 58.43 58.43 92.52 137.41Q914-571 914-480q0 91-34.08 169.99-34.09 78.98-92.52 137.41-58.43 58.43-137.41 92.52Q571-46 480-46Zm0-126q130 0 219-89t89-219q0-130-89-219t-219-89q-130 0-219 89t-89 219q0 130 89 219t219 89Zm0-308Z"/>
                                    </svg>
                                </span>
                            </p>
                        </div>
                    ';
                }else{
                    $summary .= '
                        <div class="w-full">
                            <p class="text-base font-medium mb-1 leading-5">'.($index+1).'. '.$question->question.'</p>
                            <p class="text-base font-semibold w-full leading-5">
                                <span>Answer:</span> 
                                <span class="text-red-600">
                                    '.$allAnswers[$index]->answer.'
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-5 h-5 inline" fill="currentColor">
                                        <path xmlns="http://www.w3.org/2000/svg" d="m347-280 133-133 133 133 67-67-133-133 133-133-67-67-133 133-133-133-67 67 133 133-133 133 67 67ZM480-46q-91 0-169.99-34.08-78.98-34.09-137.41-92.52-58.43-58.43-92.52-137.41Q46-389 46-480q0-91 34.08-169.99 34.09-78.98 92.52-137.41 58.43-58.43 137.41-92.52Q389-914 480-914q91 0 169.99 34.08 78.98 34.09 137.41 92.52 58.43 58.43 92.52 137.41Q914-571 914-480q0 91-34.08 169.99-34.09 78.98-92.52 137.41-58.43 58.43-137.41 92.52Q571-46 480-46Zm0-126q130 0 219-89t89-219q0-130-89-219t-219-89q-130 0-219 89t-89 219q0 130 89 219t219 89Zm0-308Z"/>
                                    </svg>
                                </span>
                            </p>
                        </div>
                    ';
                }
            }else if($question->type == 'Enumeration'){
                $enumAnswers = '';
                $eAAns = explode(';', $allAnswers[$index]->answer);
                $eAns = explode(';', $question->answer);

                foreach($eAAns as $ans){
                    if (in_array($ans, $eAns)) {
                            $enumAnswers .= '
                                <p class="text-lg font-semibold flex items-center">
                                    • 
                                    <span class="mx-2 text-emerald-600">'.$ans.'</span>
                                    <span class="text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-5 h-5" fill="currentColor">
                                            <path xmlns="http://www.w3.org/2000/svg" d="m421-276 297-297-83-84-214 214-102-102-83 84 185 185Zm59 230q-91 0-169.99-34.08-78.98-34.09-137.41-92.52-58.43-58.43-92.52-137.41Q46-389 46-480q0-91 34.08-169.99 34.09-78.98 92.52-137.41 58.43-58.43 137.41-92.52Q389-914 480-914q91 0 169.99 34.08 78.98 34.09 137.41 92.52 58.43 58.43 92.52 137.41Q914-571 914-480q0 91-34.08 169.99-34.09 78.98-92.52 137.41-58.43 58.43-137.41 92.52Q571-46 480-46Zm0-126q130 0 219-89t89-219q0-130-89-219t-219-89q-130 0-219 89t-89 219q0 130 89 219t219 89Zm0-308Z"/>
                                        </svg>
                                    </span>
                                </p>
                            ';
                    } else {
                        $enumAnswers .= '
                            <p class="text-lg font-semibold flex items-center">
                                • 
                                <span class="mx-2 text-red-600">'.$ans.'</span>
                                <span class="text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-5 h-5" fill="currentColor">
                                        <path xmlns="http://www.w3.org/2000/svg" d="m347-280 133-133 133 133 67-67-133-133 133-133-67-67-133 133-133-133-67 67 133 133-133 133 67 67ZM480-46q-91 0-169.99-34.08-78.98-34.09-137.41-92.52-58.43-58.43-92.52-137.41Q46-389 46-480q0-91 34.08-169.99 34.09-78.98 92.52-137.41 58.43-58.43 137.41-92.52Q389-914 480-914q91 0 169.99 34.08 78.98 34.09 137.41 92.52 58.43 58.43 92.52 137.41Q914-571 914-480q0 91-34.08 169.99-34.09 78.98-92.52 137.41-58.43 58.43-137.41 92.52Q571-46 480-46Zm0-126q130 0 219-89t89-219q0-130-89-219t-219-89q-130 0-219 89t-89 219q0 130 89 219t219 89Zm0-308Z"/>
                                    </svg>
                                </span>
                            </p>
                        ';
                    }
                }

                $summary .= '
                    <div>
                        <p class="text-base font-medium mb-1 leading-5">'.($index+1).'. '.$question->question.'</p>
                        <p class="text-base font-semibold flex items-center">Answer:</p>
                        '.$enumAnswers.'
                    </div>
                ';
            }
        }

        $content = '
            <div class="h-full flex flex-col p-4 gap-y-4 mb-2">
                <div class="w-full">
                    <button id="backResultButton" class="h-12 border rounded-xl bg-blue-500 text-white font-black tracking-wider px-4 flex items-center justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="currentColor">
                            <path d="M424-56 0-480l424-424 80 81-343 343 343 343-80 81Z"/>
                        </svg>
                        <div>BACK</div>
                        <div class="w-6"></div>
                    </button>
                </div>
                '.$summary.'
            </div>
        ';

        echo $content;
    }

    public function attendeeSurvey(Request $request){
        $key = $request->key;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }
        $akey = $request->a;
        $attendee = Attendees::where('key', $akey)->first();
        $questions = SurveyQuestion::where('is_deleted', 0)->orderBy('position', 'asc')->get();
        $is_submitted = AttendeesSurveyAnswers::where('training_key', $key)->where('attendee_key', $akey)->count();

        return view('user.training-assessment.attendees.survey.index', compact('attendee', 'key', 'akey', 'questions', 'is_submitted'));
    }

    public function attendeeSurveySubmit(Request $request){
        $key = $request->key;
        $training = ModelsRequest::where('key', $key)->first();
        if(!$key || !$training){
            return redirect()->route('dashboard.index');
        }
        $akey = $request->a;
        $questionCount = SurveyQuestion::count();
        for ($i=0; $i < $questionCount; $i++) { 
            $answerVar = 'answer'.$i;
            $question = SurveyQuestion::where('position', ($i+1))->orderBy('position', 'asc')->first();

            if($request->$answerVar != null){
                $surveyAnswer = new AttendeesSurveyAnswers();
                $surveyAnswer->training_key = $key;
                $surveyAnswer->attendee_key = $akey;
                $surveyAnswer->question_id = $question->id;
                $surveyAnswer->answer = $request->$answerVar;
                $surveyAnswer->save();
            }
        }

        return redirect()->route('attendeeSurvey', ['key' => $key, 'a' => $akey]);
    }
}
