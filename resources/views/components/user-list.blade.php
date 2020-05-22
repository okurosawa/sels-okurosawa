<div class="bg-white border shadow p-4 mb-4">
    <h1>{{ $headline }}</h1>
    <div class="row">
        @foreach ($users as $user)
        <div class="col-lg-6">
            <div class="d-flex justify-content-between border mb-4">
                <div class="align-self-center">
                    <div class="d-inline-block thumbnail-container p-3 mr-4">
                        @if (empty($user->avatar_path))
                            <img class="img-thumbnail" src="{{ asset('/images/user_icon_sample.png') }}">
                        @else
                            <img class="img-thumbnail" src="{{ asset($user->avatar_path) }}">
                        @endif
                    </div>
                </div>
                <h3 class="d-inline-block align-self-center">
                    <a href="{{ route('user.profile', ['user' => $user->id]) }}">
                        {{ $user->first_name }}
                        {{ $user->last_name }}
                    </a>
                </h3>
                <div class="d-inline-block align-self-center p-4">
                    @if($user->id != Auth::id())
                        @if(Auth::user()->is_following($user->id))
                            <a class="btn btn-danger" href="{{ route('user.unfollow', ['user' => $user->id]) }}">Unfollow</a>
                        @else
                            <a class="btn btn-primary" href="{{ route('user.follow', ['user' => $user->id]) }}">Follow</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>

    @if (count($users) == 0)
        <h3>No user.</h3>
    @endif
</div>
