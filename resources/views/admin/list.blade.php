@extends('layouts.admin-app')

@section('content')
<div class="container py-4">
    <div class="bg-white border shadow p-4 mb-4">
        <h1>Admin List Page</h1>
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
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            <div class="d-inline-block thumbnail-container">
                                @if (empty($user->avatar_path))
                                    <img class="img-thumbnail" src="{{ asset('/images/user_icon_sample.png') }}">
                                @else
                                    <img class="img-thumbnail" src="{{ $user->avatar_path }}">
                                @endif
                            </div>
                        </td>
                        <td>
                            {{ $user->first_name }}
                            {{ $user->last_name }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button type="button" class="btn btn-warning" onclick="location.href='{{ route('admin.edit', ['user' => $user->id]) }}'">
                                Edit
                            </button>
                            @if($user->id !== Auth::id())
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#admin-delete-{{ $user->id }}">
                                    Delete
                                </button>
                                <!-- Delete modal -->
                                <div class="modal fade" id="admin-delete-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.delete', ['user' => $user->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <p class="text-center text-danger">Are you sure to delete?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                    <input type="submit" class="btn" value="Delete">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Delete modal -->
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-5 py-4">
            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href='{{ route('admin.add') }}'">
                {{ __('Add Admin') }}
            </button>
        </div>
    
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>    
</div>
@endsection
