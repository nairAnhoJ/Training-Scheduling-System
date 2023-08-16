<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function store(Request $request){
        $users = User::where('id', '!=', Auth::user()->id)->where('id', '!=', 1)->get();

        $unique = false;
        $key = null;

        while (!$unique) {
            $key = Str::uuid()->toString();
            $existingModel = Comment::where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        foreach($users as $user){
            $newComment = new Comment();
            $newComment->req_id = $request->id;
            $newComment->user_id = $user->key;
            $newComment->commenter_id = Auth::user()->key;
            $newComment->content = $request->content;
            $newComment->is_read = 0;
            $newComment->key = $key;
            $newComment->save();
        }
        
        $result = '';

        $comments = Comment::select('comments.key', DB::raw('MAX(comments.content) as content'), DB::raw('MAX(comments.created_at) as created_at'), DB::raw('MAX(users.first_name) as ufname'), DB::raw('MAX(users.last_name) as ulname'))
            ->join('users', 'comments.commenter_id', '=', 'users.key')
            ->where('comments.req_id', $request->id)
            ->groupBy('key')
            ->get();

        foreach ($comments as $comment) {
            $dateTimeObj = new DateTime($comment->created_at);
            $date = $dateTimeObj->format('F j, Y');
            $time = $dateTimeObj->format('h:i A');
            $result .= '
                <div class="my-2 border border-gray-400 shadow p-2 rounded-lg">
                    <div class="flex flex-col leading-4">
                        <h1 class="font-semibold">'.$comment->ufname.' '.$comment->ulname.'</h1>
                        <p class="text-sm mb-2">'.$date.' at '.$time.'</p>
                        <p>'.$comment->content.'</p>
                    </div>
                </div>
            ';
        }

        echo $result;
    }
}
