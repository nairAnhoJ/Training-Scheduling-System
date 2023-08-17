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

        $comments = Comment::select('tss_comments.key', DB::raw('MAX(tss_comments.content) as content'), DB::raw('MAX(tss_comments.created_at) as created_at'), DB::raw('MAX(tss_users.first_name) as ufname'), DB::raw('MAX(tss_users.last_name) as ulname'))
            ->join('tss_users', 'tss_comments.commenter_id', '=', 'tss_users.key')
            ->where('tss_comments.req_id', $request->id)
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
