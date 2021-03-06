
<div class="bg-white border shadow p-4 mb-4">
    <h2>Activities</h2>
    <hr>
    @foreach ($activities as $activity)
        @isset($activity->activityMorph)
            <div class="mb-4 p-3 border">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-2 col-2">
                        @if (empty($activity->user->avatar_path))
                            <img class="img-thumbnail" src="{{ asset('/images/user_icon_sample.png') }}">
                        @else
                            <img class="img-thumbnail" src="{{ $activity->user->avatar_path }}">
                        @endif
                    </div>
                    <h3 class="col-lg-10 col-md-9 col-sm-10 col-10">
                        @if (isset($activity->activityMorph->follower_id))
                            @if(isset($activity->user->deleted_at))
                                {{ $activity->user->first_name }}
                            @else
                                <a href="{{ route('user.profile', ['user' => $activity->activityMorph->follower_id]) }}">
                                    {{ $activity->user->first_name }}
                                </a>
                            @endif
                            <span>followed</span>
                            @if(isset($activity->activityMorph->followingUser->deleted_at))
                                {{ $activity->activityMorph->followingUser->first_name }}
                            @else
                                <a href="{{ route('user.profile', ['user' => $activity->activityMorph->followingUser->id]) }}">
                                    {{ $activity->activityMorph->followingUser->first_name }}
                                </a>
                            @endif
                        @elseif(isset($activity->activityMorph->category_id))
                            @if(isset($activity->user->deleted_at))
                                {{ $activity->user->first_name }}
                            @else
                                <a href="{{ route('user.profile', ['user' => $activity->activityMorph->user_id]) }}">
                                    {{ $activity->user->first_name }}
                                </a>
                            @endif
                            <span>
                                learned
                                {{ $activity->activityMorph->choices->where('correct_answer_flag', true)->count() }}
                                of
                                {{ $activity->activityMorph->category->words->count() }}
                                words
                            </span>
                            <a href="{{ route('lesson.result', ['lesson' => $activity->activityMorph->id]) }}">{{ $activity->activityMorph->category->title }}</a>
                        @endif
                    </h3>
                </div>
                <p class="text-right m-0">{{ $activity->updated_at }}</p>
            </div>
        @endisset
    @endforeach

    @if (count($activities) == 0)
        <h3>No activity.</h3>
    @endif
</div>
