<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function createComment(Request $request, Post $post){
        $fields = $request->validate([
            'content'=>['required','min:1','max:255'],
            'parent_id'=> 'nullable|exists:comments,id',

        ]);
        $fields['user_id'] = auth()->id();
        $fields['post_id'] = $post->id;
/* The line `['content'] = strip_tags(['content']);` is sanitizing the content input by
removing any HTML tags from the content. This is done to prevent any potential security
vulnerabilities such as cross-site scripting (XSS) attacks by ensuring that only plain text content
is stored in the database. */
        $fields['content'] = strip_tags($fields['content']);
        
        Comment::create($fields);

        return redirect('/post/'. $post->id);
    }
}
