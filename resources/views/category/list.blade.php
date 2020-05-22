@extends('layouts.app')

@section('content')
<div class="container py-4">
    @include('components.category-list', ['categories' => $categories])
</div>
@endsection
