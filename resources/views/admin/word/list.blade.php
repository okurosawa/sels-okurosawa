@extends('layouts.admin-app')

@section('content')
    <div class="container bg-white shadow my-4 py-4">
        <h1>Word List Page for Category of "{{ $category->title }}"</h1>
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
                    <th>No.</th>
                    <th>Content</th>
                    <th>Choices</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($words as $word)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('admin.choice.list', ['word' => $word->id]) }}">
                                {{ $word->content }}
                            </a>
                        </td>
                        <td>{{ $word->choices->count() }}</td>
                        <td>
                            <button type="button" class="btn btn-warning" onclick="location.href='{{ route('admin.word.edit', ['word' => $word->id]) }}'">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#word-delete-{{ $word->id }}">
                                Delete
                            </button>
                            <!-- Delete modal -->
                            <div class="modal fade" id="word-delete-{{ $word->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.word.delete', ['word' => $word->id]) }}" method="POST">
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
            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href='{{ route('admin.word.add', ['category' => $category->id]) }}'">
                {{ __('Add Word') }}
            </button>
        </div>

        <div class="d-flex justify-content-center">
            {{ $words->links() }}
        </div>

        <button type="button" onclick="location.href='{{ route('admin.home') }}'" class="btn btn-secondary">Back</button>
    </div>
@endsection
