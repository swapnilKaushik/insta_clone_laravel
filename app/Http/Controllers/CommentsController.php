<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function store($post, $user) 
    {
        $data = request()->validate([
            'comment' => 'required',
        ]);

        \App\Models\Comment::create([
            'comment' => $data['comment'],
            'post_id' => $post,
            'user_id' => $user,
        ]);

        return redirect('/p/' . $post);
    }
}
