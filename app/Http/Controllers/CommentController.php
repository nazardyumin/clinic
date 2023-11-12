<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function show()
    {
        $comments = Comment::all();
        return view('comments.comments', compact('comments'));
    }

    public function add(Request $request)
    {
        Comment::create([
            'user_id' => $request->user_id,
            'comment' =>  $request->comment
        ]);

        return redirect(route('comments'));
    }
}
