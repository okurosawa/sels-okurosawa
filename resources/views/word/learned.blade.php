@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-4 col-md-5 p-4">
            @include('components.user-individual', ['user', $user])
        </div>

        <div class="col-lg-8 col-md-7 p-4">
            @include('components.word-learned-list', ['answers', $answers])
        </div>
    </div>
</div>
@endsection
