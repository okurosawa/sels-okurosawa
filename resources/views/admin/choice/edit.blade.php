@extends('layouts.admin-app')

@section('content')
    <div class="container bg-white shadow my-4 py-4">
        <h1>Choice Edit Page for Choice of "{{ $choice->content }}"</h1>
        @if (session('my_status'))
            <div class="container mt-2">
                <div class="alert alert-success font-weight-bold">
                    {{ session('my_status') }}
                </div>
            </div>
        @endif
        <form action="{{ route('admin.choice.update', ['choice' => $choice->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="word">Choice</label>
                <input type="text" name="content" class="form-control" value="{{ $choice->content }}" maxlength="255" required>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="button" onclick="location.href='{{ route('admin.choice.list', ['word' => $choice->word_id]) }}'" class="btn btn-secondary">Back</button>
                <input type="submit" value="Save" class="btn btn-success px-5">
            </div>
        </form>
    </div>
@endsection
