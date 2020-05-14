@extends('layouts.admin-app')

@section('content')
    <div class="container bg-white shadow my-4 py-4">
        <h1>Category Add Page</h1>
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" maxlength="255" required>
            </div>
        
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" name="description" class="form-control" maxlength="255" required>
            </div>
        
            <div class="form-group d-flex justify-content-between">
                <button type="button" onclick="location.href='{{ route('admin.home') }}'" class="btn btn-secondary">Back</button>
                <input type="submit" value="Add" class="btn btn-success px-5">
            </div>
        </form>
    </div>
@endsection
