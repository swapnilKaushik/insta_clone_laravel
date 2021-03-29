<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function store($posts, $user) 
    {
        return $posts->likes()->toggle($user);
    }

}
