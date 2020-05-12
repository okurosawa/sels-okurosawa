
<div class="bg-white border shadow p-4 mb-4">
    <h2>Activities</h2>
    <hr>
    @foreach ($activities as $activity)
        <div class="mb-4 p-3 border">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-2 col-2">
                        @if (empty($activity->user->avatar_path))
                            <img class="img-thumbnail" src="{{ asset('/images/user_icon_sample.png') }}">
                        @else
                            <img class="img-thumbnail" src="{{ asset($activity->user->avatar_path) }}">
                        @endif
                    </div>
                    <h3 class="col-lg-10 col-md-9 col-sm-10 col-10">
                        @if (isset($activity->activityMorph->follower_id))
                            <a href="#">{{ $activity->user->first_name }}</a>
                            <span>followed</span>
                            <a href="#">{{ $activity->activityMorph->followingUser->first_name }}</a>
                        @elseif(isset($activity->activityMorph->category_id))
                            <a href="#">{{ $activity->user->first_name }}</a>
                            <span>
                                learned
                                {{ $activity->activityMorph->answers->count() }}
                                of
                                {{ $activity->activityMorph->category->words->count() }}
                                words
                            </span>
                            <a href="#">{{ $activity->activityMorph->category->title }}</a>
                        @endif
                    </h3>
                </div>
            <p class="text-right m-0">{{ $activity->updated_at }}</p>
        </div>
    @endforeach

    @if (count($activities) == 0)
        <h3>No activity.</h3>
    @endif
</div>
