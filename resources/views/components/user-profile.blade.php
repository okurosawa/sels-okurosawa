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
            {{ $user->first_name }}
            {{ $user->last_name }}
        </h2>

        <hr>

        <div class="d-flex justify-content-around">
            <div class="p-2">
                <a class="d-inline-block btn btn-primary" href="#">
                    <span class="font-weight-bold">{{ $user->answers_count }}</span>
                    <p>words learned</p>
                </a>
            </div>

            <div class="p-2">
                <a class="d-inline-block btn btn-primary" href="#">
                    <span class="font-weight-bold">{{ $user->lessons_count }}</span>
                    <p>lessons learned</p>
                </a>
            </div>
        </div>
    </div>
</div>
