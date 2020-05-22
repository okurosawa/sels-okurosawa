@extends('layouts.app')

@section('content')
<div class="container py-4">
    @include('components.user-list', ['users' => $following, 'headline' => "{$user->first_name}'s following"])
</div>
@endsection
