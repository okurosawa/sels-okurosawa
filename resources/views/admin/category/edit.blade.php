@extends('layouts.admin-app')

@section('content')
    <div class="container bg-white shadow my-4 py-4">
        <h1>Category Edit Page</h1>
        @isset($category)
            <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" value="{{ $category->title }}" maxlength="255" required>
                </div>
            
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" name="description" class="form-control" value="{{ $category->description }}" maxlength="255" required>
                </div>
            
                <div class="form-group d-flex justify-content-between">
                    <button type="button" onclick="location.href='{{ route('admin.home') }}'" class="btn btn-secondary">Back</button>
                    <input type="submit" value="Save" class="btn btn-success px-5">
                </div>
            </form>
        @else
            <hr>
            <h2>It's not exists category.</h2>
            <button type="button" onclick="location.href='{{ route('admin.home') }}'" class="btn btn-secondary">Back</button>
        @endisset
    </div>
@endsection
