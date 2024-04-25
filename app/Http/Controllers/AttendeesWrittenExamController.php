<?php

namespace App\Http\Controllers;

use App\Models\Attendees;
use App\Models\AttendeesWrittenExamAnswers;
use App\Models\Request as ModelsRequest;
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

        return view('user.training-assessment.attendees.exam.index', compact('attendee', 'key', 'akey', 'exam'));
    }

    public function npQuestion(Request $request){
        // dd($request);
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
        $Pquestion = null;

        if($q != "0"){
            $Pquestion = WrittenExamQuestion::where('exam_key', $exam->key)->orderBy('id')->skip(($q-1))->first();
            $Pawea = AttendeesWrittenExamAnswers::where('training_key', $key)->where('attendee_key', $akey)->where('question_id', $Pquestion->id)->first();
        }


        if($nob == 'NEXT'){
            $q++;
        }else{
            $q--;
        }

        $question = WrittenExamQuestion::where('exam_key', $exam->key)->orderBy('id')->skip(($q-1))->first();
        
        $answer = $request->answer;
        $content = '';
        $points = 0;

        $awea = AttendeesWrittenExamAnswers::where('training_key', $key)->where('attendee_key', $akey)->where('question_id', $question->id)->first();

        if($awea != null){
            $nAnswer = $awea->answer;
        }else{
            $nAnswer = null;
        }

        if($Pquestion != null && strtolower($answer) == strtolower($Pquestion->answer)){
            $points = $Pquestion->points;
        }

        if($nob != 'SUBMIT'){
            if($q != 0){
                if($question->type == 'MultipleChoice' || $question->type == 'TrueOrFalse'){
    
                    if($question->type == 'MultipleChoice'){
                        $options = explode(';', $question->options);
                        shuffle($options);
                    }else{
                        $options = ['True', 'False'];
                    }
        
                    $theOptions = '';
                    foreach($options as $index => $option){
                        $theOptions .= '
                            <div class="flex items-center">
                                <input '.(($nAnswer == $option) ? 'checked' : '').' id="option'.$index.'" type="radio" value="'.$option.'" name="answer" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="option'.$index.'" class="ms-2 text-lg font-medium text-gray-900">'.ucfirst($option).'</label>
                            </div>
                        ';
                    }
        
                    $content = '
                                    <div class="h-full">
                                        <p class="text-xl font-bold mb-10">'.$q.'. '.$question->question.'</p>
                                        <div class="flex flex-col gap-y-2">
                                            '.$theOptions.'
                                        </div>
                                    </div>
                                ';
                }else if($question->type == 'ShortAnswer' || $question->type == 'Enumeration'){
                    // if($question->type == 'ShortAnswer'){
                    //     $points = 1;
                    // }else{
                        $points = $question->points;
                    // }
        
                    $theAnswers = '';
    
                    for ($i=0; $i < $points; $i++) {
                        $theAnswers .= '
                            <div class="w-full">
                                <input type="text" id="answer'.$i.'" name="answer'.$i.'" value="'.$nAnswer.'" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
                            </div>
                        ';
                    }
        
                    $content = '
                                    <div class="h-full">
                                        <p class="text-xl font-bold mb-10">'.$q.'. '.$question->question.'</p>
                                        <div class="flex flex-col gap-y-3">
                                            '.$theAnswers.'
                                        </div>
                                    </div>
                                ';
                }
            }else{
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
            }

            if($nob == 'BACK' || (($q > 1) && ($nob == 'NEXT'))){
                if($answer != null){
                    if($Pawea == null){
                        $nawea = new AttendeesWrittenExamAnswers();
                        $nawea->training_key = $key;
                        $nawea->attendee_key = $akey;
                        $nawea->exam_key = $exam->key;
                        $nawea->question_id = $Pquestion->id;
                        $nawea->answer = $answer;
                        $nawea->points = $points;
                        $nawea->save();
                    }else{
                        $Pawea->answer = $answer;
                        $Pawea->points = $points;
                        $Pawea->save();
                    }
                }
            }
        }else{

            if($Pawea == null){
                $nawea = new AttendeesWrittenExamAnswers();
                $nawea->training_key = $key;
                $nawea->attendee_key = $akey;
                $nawea->exam_key = $exam->key;
                $nawea->question_id = $Pquestion->id;
                $nawea->answer = $answer;
                $nawea->points = $points;
                $nawea->save();
            }else{
                $Pawea->answer = $answer;
                $Pawea->points = $points;
                $Pawea->save();
            }

            $examResult = AttendeesWrittenExamAnswers::where('training_key', $key)->where('attendee_key', $akey)->where('points', '1')->count();
            $attendee->written_score = $examResult;
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
        }

        echo $content;
    }

    // public function sQuestion(Request $request){
    //     $key = $request->key;
    //     $training = ModelsRequest::where('key', $key)->first();
    //     if(!$key || !$training){
    //         return redirect()->route('dashboard.index');
    //     }
    //     dd($request);
        
    //     $content = '';
    //     $akey = $request->akey;
    //     $attendee = Attendees::where('key', $akey)->first();
    //     $exam  = WrittenExam::find($attendee->written_exam);
    //     $Pquestion = WrittenExamQuestion::where('exam_key', $exam->key)->orderBy('id')->skip(($q-1))->first();
        
    //     if($Pquestion != null && strtolower($answer) == strtolower($Pquestion->answer)){
    //         $points = $Pquestion->points;
    //     }

    //     if($Pawea == null){
    //         $nawea = new AttendeesWrittenExamAnswers();
    //         $nawea->training_key = $key;
    //         $nawea->attendee_key = $akey;
    //         $nawea->exam_key = $exam->key;
    //         $nawea->question_id = $Pquestion->id;
    //         $nawea->answer = $answer;
    //         $nawea->points = $points;
    //         $nawea->save();
    //     }else{
    //         $Pawea->answer = $answer;
    //         $Pawea->points = $points;
    //         $Pawea->save();
    //     }
    // }
}
