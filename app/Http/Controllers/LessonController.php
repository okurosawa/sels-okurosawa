<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Activity;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;
use Illuminate\Support\Facades\Auth;

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
            $activity = new Activity();
            $activity->logActivity(Auth::id(), $lesson->id, 'App\Lesson');

            return redirect()->route('lesson.result', ['lesson' => $lesson->id]);
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

    public function result(Lesson $lesson)
    {
        return view('lesson.result', compact('lesson'));
    }
}
