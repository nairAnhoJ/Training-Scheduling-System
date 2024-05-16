<?php

namespace App\Http\Controllers;

use App\Models\DrivingExam;
use App\Models\DrivingExamLayout;
use Illuminate\Http\Request;

class DrivingExamLayoutController extends Controller
{
    public function index(Request $request){
        $key = $request->key;
        $exam = DrivingExam::where('key', $key)->first();
        if($exam == null){
            return redirect()->route('driving.index');
        }

        $areas = DrivingExamLayout::where('driving_exam_key', $key)->get();

        return view('user.training-assessment.exam.driving.layout.index', compact('areas', 'key'));
    }

    public function store(Request $request){
        $key = $request->key;
        $exam = DrivingExam::where('key', $key)->first();
        if($exam == null){
            return redirect()->route('driving.index');
        }

        $name = $request->name;
        $color = $request->color;

        $request->validate([
            'color' => 'required',
        ]);

        $newArea = new DrivingExamLayout();
        $newArea->driving_exam_key = $key;
        $newArea->name = $name;
        $newArea->color = $color;
        $newArea->top = 4;
        $newArea->left = 888;
        $newArea->height = 90;
        $newArea->width = 90;
        $newArea->width_ratio = 0.1;
        $newArea->height_ratio = 0.1;
        $newArea->left_ratio = 1.15;
        $newArea->save();

        return redirect()->route('driving.layout.edit', ['key' => $key, 'id' => $newArea->id]);
    }

    public function edit(Request $request){
        $key = $request->key;
        $exam = DrivingExam::where('key', $key)->first();
        if($exam == null){
            return redirect()->route('driving.index');
        }

        $id = $request->id;
        $areas = DrivingExamLayout::get();
        $thisArea = DrivingExamLayout::where('driving_exam_key', $key)->where('id', $id)->first();
        return view('user.training-assessment.exam.driving.layout.edit', compact('areas', 'id', 'thisArea', 'key'));
    }

    public function update(Request $request){
        $key = $request->key;
        $exam = DrivingExam::where('key', $key)->first();
        if($exam == null){
            return redirect()->route('driving.index');
        }

        $id = $request->id;
        $top = $request->top;
        $left = $request->left;
        $height = $request->height;
        $width = $request->width;
        $heightRatio = $request->heightRatio;
        $widthRatio = $request->widthRatio;
        $leftRatio = $request->leftRatio;
        $color = $request->color;

        $layout = DrivingExamLayout::where('driving_exam_key', $key)->where('id', $id)->first();
        $layout->top = $top;
        $layout->left = $left;
        $layout->height = $height;
        $layout->width = $width;
        $layout->width_ratio = $widthRatio;
        $layout->height_ratio = $heightRatio;
        $layout->left_ratio = $leftRatio;
        $layout->color = $color;
        $layout->Save();

        return redirect()->route('driving.layout.index', ['key' => $key]);
    }

    public function delete(Request $request){
        $key = $request->key;
        $exam = DrivingExam::where('key', $key)->first();
        if($exam == null){
            return redirect()->route('driving.index');
        }

        $id = $request->id;
        DrivingExamLayout::where('driving_exam_key', $key)->where('id', $id)->delete();
        return redirect()->route('driving.layout.index', ['key' => $key]);
    }
}
