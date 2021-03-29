@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" 
                class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                
                <div class="d-flex align-items-center">
                    <h1>{{ $user->username }}</h1>
                    @if( Auth::user()->id != $user->id )
                        <follow-button user_id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    @endif
                </div>

                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan

            </div>

            <!-- accessing policy in blade -->
            @can('update', $user->profile)
                <div class="pb-1">
                    <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                </div>
            @endcan

            <div class="d-flex">
                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <!-- <div class="pt-4"><strong>freegram.com</strong></div>
            <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</div>
            <div><a href="#">www.freegram.com</a></div> -->
            <div class="pt-4"><strong>{{ $user->profile->title }}</strong></div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url ?? 'N/A'}}</a></div>
        </div>
        <!-- <div class="row pt-5">
            <div class="col-4">
                <img src="https://instagram.flko7-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c96.0.887.887a/s640x640/74362742_567065610695180_848376768043779501_n.jpg?tp=1&_nc_ht=instagram.flko7-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=rvHOM64giwEAX-abUkQ&ccb=7-4&oh=e2a9b2b745e38f8c763b31da6db5f0af&oe=60887FAF&_nc_sid=7bff83" class="w-100">
            </div>
            <div class="col-4">
                <img src="https://instagram.flko7-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c96.0.887.887a/s640x640/74362742_567065610695180_848376768043779501_n.jpg?tp=1&_nc_ht=instagram.flko7-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=rvHOM64giwEAX-abUkQ&ccb=7-4&oh=e2a9b2b745e38f8c763b31da6db5f0af&oe=60887FAF&_nc_sid=7bff83"
                    class="w-100">
            </div>
            <div class="col-4">
                <img src="https://instagram.flko7-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/c96.0.887.887a/s640x640/74362742_567065610695180_848376768043779501_n.jpg?tp=1&_nc_ht=instagram.flko7-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=rvHOM64giwEAX-abUkQ&ccb=7-4&oh=e2a9b2b745e38f8c763b31da6db5f0af&oe=60887FAF&_nc_sid=7bff83"
                    class="w-100">
            </div>
        </div> -->

        <div class="row pt-5">
            @foreach($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" class="w-100">
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
