<div class="card shadow text-center p-2">
    <div class="icon_container mx-auto my-3">
        @if (empty($user->avatar_path))
            <img class="card-img-top img-thumbnail" src="{{ asset('/images/user_icon_sample.png') }}">
        @else
            <img class="card-img-top img-thumbnail" src="{{ asset($user->avatar_path) }}">
        @endif
    </div>

    <div class="card-body">
        <h2 class="card-title">
            <a href="{{ route('user.profile', ['user' => $user->id]) }}">
                {{ $user->first_name }}
                {{ $user->last_name }}
            </a>
        </h2>

        <div class="text-center p-2">
            @if($user->id == Auth::id())
                <button class="btn btn-primary px-4">Edit Profile</button>
            @elseif(Auth::user()->is_following(($user->id)))
                <a class="btn btn-danger px-4" href="{{ route('user.unfollow', ['user' => $user->id]) }}">Unfollow</a>
            @else
                <a class="btn btn-primary px-4" href="{{ route('user.follow', ['user' => $user->id]) }}">Follow</a>
            @endif
        </div>

        <hr>

        <div class="d-flex justify-content-around">
            <div class="p-2">
                <a href="{{ route('user.follower', ['user' => $user->id]) }}">
                    <span class="font-weight-bold">{{ $user->followers->count() }}</span>
                </a>
                <p>followers</p>
            </div>

            <div class="p-2">
                <a href="{{ route('user.following', ['user' => $user->id]) }}">
                    <span class="font-weight-bold">{{ $user->following->count() }}</span>
                </a>
                <p>following</p>
            </div>
        </div>

        <div class="text-center">
            <p>
                <a href="#">
                    Learned {{ $user->answers->count() }} words
                </a>
            </p>
            <p>
                <a href="#">
                    Learned {{ $user->lessons->count() }} lessons
                </a>
            </p>
        </div>
    </div>
</div>
