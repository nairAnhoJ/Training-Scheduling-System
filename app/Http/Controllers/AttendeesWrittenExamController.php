<?php

namespace App\Http\Controllers;

use App\Models\Attendees;
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
        $q = $request->q;
        $question = WrittenExamQuestion::where('exam_key', $exam->key)->orderBy('id')->skip(($q-1))->first();
        $answer = $request->answer;
        $optionLetters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k'];
        $content = '';

        if($q != 0){
            if($question->type == 'MultipleChoice' || $question->type == 'TrueOrFalse'){
                if($question->type == 'MultipleChoice'){
                    $options = explode(',', $question->options);
                }else{
                    $options = ['True', 'False'];
                }
    
                $theOptions = '';
                foreach($options as $index => $option){
                    $theOptions .= '
                        <div class="flex items-center">
                            <input id="option'.$index.'" type="radio" value="'.$optionLetters[$index].'" name="answer" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            <label for="option'.$index.'" class="ms-2 text-lg font-medium text-gray-900">'.$option.'</label>
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
                if($question->type == 'ShortAnswer'){
                    $points = 1;
                }else{
                    $points = $question->points;
                }
    
                $theAnswers = '';

                for ($i=0; $i < $points; $i++) {
                    $theAnswers .= '
                        <div class="w-full">
                            <input type="text" id="answer'.$i.'" name="answer'.$i.'" class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg block w-full p-2.5" autocomplete="off">
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

        echo $content;
    }
}
