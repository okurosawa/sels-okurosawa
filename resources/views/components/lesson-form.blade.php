<div class="bg-white shadow p-4 mb-4">
    <h1 class="mb-4">
        {{ $lesson->category->title }}
        ({{ $lesson->answers->count() + 1 }} of {{ $lesson->category->words->count() }})
    </h1>
    <form action="{{ route('lesson.answer', ['lesson' => $lesson->id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6 d-flex text-center justify-content-center align-items-center bg-light mb-4">
                <h2 class="p-4">{{ $word->content }}</h2>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="btn-group-toggle" data-toggle="buttons">
                        @foreach ($word->choices as $choice)
                            <div class="input-group mb-2">
                                <label class="btn btn-block btn-outline-primary">
                                    <input type="radio" name="choiceId" class="form-control d-none" value="{{ $choice->id }}" autocomplete="off" required>
                                    {{ $choice->content }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" name="wordId" value="{{ $word->id }}">
                <input type="submit" value="Submit" class="btn btn-success btn-block">
            </div>
        </div>
    </form>
</div>
