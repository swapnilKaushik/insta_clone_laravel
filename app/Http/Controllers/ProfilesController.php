<?php

namespace App\Http\Controllers;

use App\Models\User;    # first letter must be Capital
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user)
    {

        $user = User::findOrFail($user);

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.post.' . $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->posts->count();
            }
        );

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->profile->followers->count();
            }
        );

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->following->count();
            }
        );

        return view('profiles.index', [
            'user' => $user,
            'follows' => $follows,
            'postCount' => $postCount,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
        ]);
    }

    public function edit(\App\Models\User $user) 
    {
        # restricting action using policy
        $this->authorize('update', $user->profile);

        return view('profiles/edit', compact('user'));
    }

    public function update(\App\Models\User $user) 
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => 'image'
        ]);

        if( request('image') ) {
            # storing the image in LocalStorage(public) in uploads folder in storage
            $imagePath = request('image')->store('profile', 'public');
            
            # image manipulation
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            auth()->user()->profile->update(
                array_merge(
                    $data,
                    ['image' => $imagePath]
                )
            );
        } else {
            auth()->user()->profile->update($data);
        }

        return redirect("/profile/{$user->id}");

    }
}
