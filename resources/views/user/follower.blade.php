@extends('layouts.app')

@section('content')
<div class="container py-4">
    @include('components.user-list', ['users' => $followers, 'headline' => "{$user->first_name}'s follower"])
</div>
@endsection
