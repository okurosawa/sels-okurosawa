@extends('layouts.admin-app')

@section('content')
    <div class="container bg-white shadow my-4 py-4">
        <h1>Word Add Page for Category of "{{ $category->title }}"</h1>
        @if (session('my_status'))
            <div class="container mt-2">
                <div class="alert alert-success font-weight-bold">
                    {{ session('my_status') }}
                </div>
            </div>
        @endif
        <form action="{{ route('admin.word.store', ['category' => $category->id]) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="word">Word</label>
                        <input type="text" name="content" class="form-control" maxlength="255" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="choices">{{ __('Choices (Click radio button if it is correct answer)') }}</label>
                        @for ($i = 0; $i < 4; $i++)
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="correct_answer" value="{{ $i }}" {{ $i == 0 ? 'checked' : ''}}>
                                    </div>
                                </div>
                                <input type="text" name="choices[{{ $i }}]" class="form-control" maxlength="255" required>
                            </div>
                        @endfor
                    </div>
                    <input type="submit" value="Submit" class="btn btn-success btn-block">
                </div>
            </div>
        </form>
        <div class="mt-2">
            <button type="button" onclick="location.href='{{ route('admin.word.list', ['category' => $category->id]) }}'" class="btn btn-secondary">Back</button>
        </div>
    </div>
@endsection
