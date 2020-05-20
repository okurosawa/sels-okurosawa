<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Category;
use App\Http\Requests\LessonRequest;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function start(Category $category)
    {
        $lesson = new Lesson();
        $currentLesson = $lesson->beginOrContinueLesson($category->id);

        return redirect()->route('lesson.question', ['lesson' => $currentLesson->id]);
    }

    public function question(Lesson $lesson)
    {
        $questions = $lesson->remainingQuestions();

        if ($questions->count() == 0) {
            // [Future task] If there is no remaining question, it will redirect to lesson result page
            // https://app.asana.com/0/1173796632051606/1174497130657835
        }

        $word = $questions->orderBy('id', 'asc')->first();

        return view('lesson.question', compact(['lesson', 'word']));
    }

    public function answer(Lesson $lesson, LessonRequest $request)
    {
        $validated = $request->validated();
        $lesson->saveAnswer($validated['wordId'], $validated['choiceId']);

        return redirect()->route('lesson.question', ['lesson' => $lesson->id]);
    }
}
