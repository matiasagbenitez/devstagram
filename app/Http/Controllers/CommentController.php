<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, User $user, Post $post) {

        // Validation
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);

        Comment::create([
            'comment'   => $request->comment,
            'user_id'   => auth()->user()->id,
            'post_id'   => $post->id,
        ]);

        return back()->with('mensaje', 'Comment posted successfully!');

    }

    public function destroy(Comment $comment)
    {
        Comment::where('id', $comment->id)->delete();
        return back();
    }
}
