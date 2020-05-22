@extends('layouts.app')

@section('content')
<div class="container py-4">
    @include('components.lesson-form', ['lesson' => $lesson, 'word' => $word])
</div>
@endsection
