@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div>
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 50px;">
                    </div>
                    <div class="pl-3 d-flex">
                        <h5>
                            <a href="/profile/{{ $post->user->id }}" style="text-decoration: none; color:black;">
                                {{ $post->user->username}}
                            </a>
                        </h5>
                        @if( Auth::user()->id != $post->user->id )
                            <follow-tag user_id="{{ $post->user->id }}"
                                follows="{{ App\Http\Controllers\PostsController::followers($post->user->id) }}"></follow-tag>
                        @endif
                    </div>
                </div>

                <hr>

                <p class="pt-3">
                    <a href="/profile/{{ $post->user->id }}" style="text-decoration: none; font-weight: 600; color:black;">
                        {{ $post->user->username }}
                    </a>
                    {{ $post->caption }}
                </p>
            </div>

            <div style="
                height: 500px;
                padding: 10px;
                overflow-y: scroll;
                overflow-x: hidden;
            " class="scrollOff">

            @if($post->comments->count() == 0)
                <div style="color: rgb(200 194 194)"> No comments yet..</div>
            @endif

            @foreach($post->comments as $comment)
                <div>
                    <a href="/profile/{{ $comment->post->user->id }}" class="d-flex align-items-center pt-1"
                    style="text-decoration: none; font-size: 12px; font-weight: 600; color:black;">
                        <img src="{{ \App\Models\User::find($comment->user_id)->profile->profileImage() }}" 
                            style="max-height: 20px;" class="px-2 rounded-circle">
                        <div>{{ \App\Models\User::find($comment->user_id)->username }}</div>
                    </a>
                    <div class="pl-5 pb-2" style="font-size: 11px;">{{ $comment->comment }}</div>
                </div>
            @endforeach
            </div>

            <div class="pt-4">
                <form action="/c/{{ $post->id }}/{{ Auth::user()->id }}" method="POST" 
                    class="d-flex align-items-start justify-content-center">
                    @csrf
                    <div class="form-group row" style="width: calc(80% - 15px);">
                        <input id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment"
                            style="border-bottom-right-radius: 0px; border-start-end-radius: 0px;"
                            value="{{ old('comment') }}" autocomplete="comment" placeholder="Add your comment here" autofocus>
            
                        @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row" style="margin-left: 15px;">
                        <button class="btn btn-primary" style="border-bottom-left-radius: 0px; border-start-start-radius: 0px;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection