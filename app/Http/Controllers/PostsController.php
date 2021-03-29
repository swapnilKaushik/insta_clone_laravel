<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    /** constructor
     *  adding middleware auth : thats require user logIn (authentication) 
     * to run this controller i.e post
     */

    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        # $posts = \App\Models\Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->get();
        # $posts = \App\Models\Post::whereIn('user_id', $users)->latest()->get();
        $posts = \App\Models\Post::whereIn('user_id', $users)->with('user')->latest()->paginate(2);

        return view('posts.index', compact('posts'));
    }

    public static function liked($userId)
    {
        # return \App\Model\Posts::likes->contains($userId);

    }

    public static function followers($userId)
    {
        return (auth()->user()) ? auth()->user()->following->contains($userId) : false;
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        // validation rule
        $data = request()->validate([
            'caption' => 'required',
            'image' => 'required | image'       
        ]); 

        # to automatically grab authenticated user & fill the user_id
        # auth()->user()->posts()->create($data);
        
        # storing the image in LocalStorage(public) in uploads folder in storage 
        $imagePath = request('image')->store('uploads', 'public');

        # image manipulation 
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        # \App\Models\Post::create($data);
        
        /** Another way of doing above -. 
         *  \App\Models\Post::create([
         *      'caption' => $data['caption'],
         *      'image' => $data['image']
         *  ]); 
        */

        /** Another long way of doing above -.
         *  $post = \App\Models\Post();
         *  $post->caption = $data['caption'];
         *  $post->image = $data['image'];
         *  $post->save();
        */

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\Post $post) 
    {
        return view('posts/show', compact('post'));
    }
}
