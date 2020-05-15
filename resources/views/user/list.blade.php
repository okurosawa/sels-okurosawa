@extends('layouts.app')

@section('content')
<div class="container py-4">
    @include('components.user-list', ['users' => $users])
</div>
@endsection
