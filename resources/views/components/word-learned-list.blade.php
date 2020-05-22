<div class="bg-white border shadow p-4 mb-4">
    <h1 class="mb-4">Words learned</h1>
    
    @if (count($answers) == 0)
        <hr>
        <h3>No learned word.</h3>
    @else
        <table class="table text-center">
            <thead>
                <th>Word</th>
                <th>Your Answer</th>
                <th>Correct Answer</th>
            </thead>
            <tbody>
                @foreach($answers as $answer)
                    <tr>
                        <td>
                            {{ $answer->word->content }}
                        </td>
                        <td>
                            <span class="{{ $answer->choice->correct_answer_flag ? 'text-success font-weight-bold' : '' }}">
                                {{ $answer->choice->content }}
                            </span>
                        </td>
                        <td>
                            @if(!$answer->choice->correct_answer_flag)
                                <span class="text-success font-weight-bold">
                                    {{ $answer->word->choices->where('correct_answer_flag', true)->first()->content }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $answers->links() }}
        </div>
    @endif
</div>
