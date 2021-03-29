@extends('layouts.app')

@section('content')
<div class="container">

    @if($posts->count() == 0)
        <div class="col-12 d-flex justify-content-center align-items-center" style="height: 70vh;">
            <h4 style="color: lightGrey;">No posts yet.</h4>
        </div>
    @endif

    @foreach($posts as $post)
        <div class="row p-2">
            <div class="col-6 offset-3 d-flex align-items-center">
                <div>
                    <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 30px;">
                </div>
                <div class="pl-3 d-flex">
                    <h6>
                        <a href="/profile/{{ $post->user->id }}" style="text-decoration: none; color:black;">
                            {{ $post->user->username}}
                        </a>
                    </h6>
                    @if( Auth::user()->id ?? '' != $post->user->id )
                        <follow-tag user_id="{{ $post->user->id }}" follows="{{ App\Http\Controllers\PostsController::followers($post->user->id) }}"></follow-tag>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 offset-3">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-6 offset-3">
                <p class="pt-2 pb-4">
                    <!-- <like-tag user_id="{{ Auth::user()->id }}" post_id="{{ $post->id }}" like="{{ App\Http\Controllers\PostsController::liked(Auth::user()->id) }}"></like-tag> -->
                    <a href="/profile/{{ $post->user->id }}" style="text-decoration: none; font-weight: 600; color:black;">
                        {{ $post->user->username}}
                    </a>
                    <span> | {{ $post->caption }} </span>
                </p>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection