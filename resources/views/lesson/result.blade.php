@extends('layouts.app')

@section('content')
<div class="container py-4">
    @include('components.lesson-result', ['lesson' => $lesson])
</div>
@endsection
