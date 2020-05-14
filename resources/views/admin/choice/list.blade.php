@extends('layouts.admin-app')

@section('content')
    <div class="container bg-white shadow my-4 py-4">
        <h1>Choice List Page for Word of "{{ $word->content }}"</h1>
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
                    <th>Correct Answer</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($choices as $choice)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $choice->content }}</td>
                        <td>
                            @if( $choice->correct_answer_flag == true)
                            <i class="fas fa-check"></i>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning" onclick="location.href='{{ route('admin.choice.edit', ['choice' => $choice->id]) }}'">
                                Edit
                            </button>
                            @if( $choice->correct_answer_flag == false)
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#choice-delete-{{ $choice->id }}">
                                    Delete
                                </button>
                                <!-- Delete modal -->
                                <div class="modal fade" id="choice-delete-{{ $choice->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.choice.delete', ['choice' => $choice->id]) }}" method="POST">
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
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-5 py-4">
            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href='{{ route('admin.choice.add', ['word' => $word->id]) }}'">
                {{ __('Add Choice') }}
            </button>
        </div>

        <div class="d-flex justify-content-center">
            {{ $choices->links() }}
        </div>

        <button type="button" onclick="location.href='{{ route('admin.word.list', ['category_id' => $word->category_id]) }}'" class="btn btn-secondary">Back</button>
    </div>
@endsection
