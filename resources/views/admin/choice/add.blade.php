@extends('layouts.admin-app')

@section('content')
    <div class="container bg-white shadow my-4 py-4">
        <h1>Choice Add Page for Word of "{{ $word->content }}"</h1>
        @if (session('my_status'))
            <div class="container mt-2">
                <div class="alert alert-success font-weight-bold">
                    {{ session('my_status') }}
                </div>
            </div>
        @endif
        <form action="{{ route('admin.choice.store', ['word' => $word->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="word">Choice</label>
                <input type="text" name="content" class="form-control" maxlength="255" required>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="button" onclick="location.href='{{ route('admin.choice.list', ['word' => $word->id]) }}'" class="btn btn-secondary">Back</button>
                <input type="submit" value="Submit" class="btn btn-success px-5">
            </div>
        </form>
    </div>
@endsection
