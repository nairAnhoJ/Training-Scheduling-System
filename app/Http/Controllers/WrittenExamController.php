<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WrittenExam;
use Illuminate\Http\Request;

class WrittenExamController extends Controller
{
    public function index(Request $request){
        $questions = WrittenExam::get();

        return view('user.training-assessment.questions.index', compact('questions'));
    }

    public function add(Request $request){
        return view('user.training-assessment.questions.add');
    }
}
