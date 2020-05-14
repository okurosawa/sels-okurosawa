@extends('layouts.admin-app')

@section('content')
    <div class="container bg-white shadow my-4 py-4">
        <h1>Word Edit Page for "{{ $word->content }}"</h1>
        @if (session('my_status'))
            <div class="container mt-2">
                <div class="alert alert-success font-weight-bold">
                    {{ session('my_status') }}
                </div>
            </div>
        @endif
        <form action="{{ route('admin.word.update', ['word' => $word->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="word">Word</label>
                        <input type="text" name="content" class="form-control" value="{{ $word->content }}" maxlength="255" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="choices">{{ __('Choices (Click radio button if it is correct answer)') }}</label>
                        @foreach ($word->choices as $choice)
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="correct_answer" value="{{ $choice->id }}" {{ $choice->correct_answer_flag == true ? 'checked' : ''}}>
                                    </div>
                                </div>
                                <input type="text" name="choices[]" class="form-control" value="{{ $choice->content }}" maxlength="255" required>
                                <input type="hidden" name="choice_ids[]" value="{{ $choice->id }}">
                            </div>
                        @endforeach
                    </div>
                    <input type="submit" value="Save" class="btn btn-success btn-block">
                </div>
            </div>
        </form>
        <div class="mt-2">
            <button type="button" onclick="location.href='{{ route('admin.word.list', ['category_id' => $word->category_id]) }}'" class="btn btn-secondary">Back</button>
        </div>
    </div>
@endsection
