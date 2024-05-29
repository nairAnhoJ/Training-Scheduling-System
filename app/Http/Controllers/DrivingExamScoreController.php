<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DrivingExamScore;
use Illuminate\Http\Request;

class DrivingExamScoreController extends Controller
{
    public function index(Request $request){
        $exams = DrivingExamScore::where('is_deleted', 0)->get();

        return view('user.training-assessment.exam.driving.index', compact('exams'));
    }
}
