
<div class="bg-white border shadow p-4 mb-4">
    <h2>Activities</h2>
    <hr>
    @foreach ($activities as $activity)
        <div class="mb-4 p-3 border">
            <div class="d-flex justify-content-between">
                <div class="align-self-center">
                    <div class="d-inline-block thumbnail-container mr-4">
                        @if (empty($activity->user->avatar_path))
                            <img class="card-img-top img-thumbnail" src="{{ asset('/images/user_icon_sample.png') }}">
                        @else
                            <img class="card-img-top img-thumbnail" src="{{ asset($activity->user->avatar_path) }}">
                        @endif
                    </div>
                    <h3 class="d-inline-block">
                        @if (isset($activity->activityMorph->follower_id))
                            <a href="#">{{ $activity->user->first_name }}</a>
                            <span>followed</span>
                            <a href="#">{{ $activity->activityMorph->followingUser->first_name }}</a>
                        @elseif(isset($activity->activityMorph->category_id))
                            <a href="#">{{ $activity->user->first_name }}</a>
                            <span>learned</span>
                            <a href="#">{{ $activity->activityMorph->category->title }}</a>
                        @endif
                    </h3>
                </div>
            </div>
            <p class="text-right m-0">{{ $activity->updated_at }}</p>
        </div>
    @endforeach

    @if (count($activities) == 0)
        <h3>No activity.</h3>
    @endif
</div>
