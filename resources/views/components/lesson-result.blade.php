<div class="bg-white border shadow p-4 mb-4">
    <h1 class="mb-4">
        {{ $lesson->category->title }}
        (
            Result:
            {{ $lesson->choices->where('correct_answer_flag', true)->count() }}
            of
            {{ $lesson->category->words->count() }}
        )
    </h1>
    <table class="table text-center">
        <thead>
            <th>Result</th>
            <th>Word</th>
            <th>Your Answer</th>
            <th>Correct Answer</th>
        </thead>
        <tbody>
            @foreach($lesson->answers as $answer)
                <tr>
                    <td>
                        @if($answer->choice->correct_answer_flag)
                            <i class="far fa-circle text-success"></i>
                        @else
                            <i class="fas fa-times text-danger"></i>
                        @endif
                    </td>
                    <td>
                        {{ $answer->word->content }}
                    </td>
                    <td>
                        {{ $answer->choice->content }}
                    </td>
                    <td>
                        {{ $answer->word->choices->where('correct_answer_flag', true)->first()->content }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
