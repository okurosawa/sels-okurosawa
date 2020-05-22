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
                @foreach ($word->choices as $choice)
                    <button typr="submit" name="choiceId" value="{{ $choice->id }}" class="btn btn-block btn-outline-primary">
                        {{ $choice->content }}
                    </button>
                @endforeach
                <input type="hidden" name="wordId" value="{{ $word->id }}">
            </div>
        </div>
    </form>
</div>
