@extends('layouts.admin-app')

@section('content')
    <div class="container bg-white shadow my-4 py-4">
        <h1>Category List Page</h1>
        @if (session('my_status'))
            <div class="container mt-2">
                <div class="alert alert-success font-weight-bold">
                    {{ session('my_status') }}
                </div>
            </div>
        @endif
        <table class="table text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <button type="button" class="btn btn-warning" onclick="location.href='{{ route('admin.category.edit', ['category' => $category->id]) }}'">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#category-delete-{{ $category->id }}">
                                Delete
                            </button>
                            <!-- Delete modal -->
                            <div class="modal fade" id="category-delete-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.category.delete', ['category' => $category->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <p class="text-center text-danger">Are you sure to delete?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                <input type="submit" class="btn" value="Delete"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Delete modal -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-5 py-4">
            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href='{{ route('admin.category.add') }}'">
                {{ __('Add Category') }}
            </button>
        </div>

        <div class="d-flex justify-content-center">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
