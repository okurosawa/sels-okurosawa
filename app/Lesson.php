<?php

namespace App;

use App\Answer;
use App\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['user_id', 'category_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function activities()
    {
        return $this->morphMany('App\Activity', 'activity');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function choices()
    {
        return $this->hasManyThrough(
            'App\Choice',
            'App\Answer',
            'lesson_id',
            'id',
            'id',
            'selected_choice_id'
        );
    }

    /**
     * Create new lesson or return already exists lesson
     *
     * @param integer $categoryId
     * @return object
     */
    public function beginOrContinueLesson($categoryId)
    {
        $existsLesson = $this->where('user_id', Auth::id())
            ->where('category_id', $categoryId)->first();

        if (isset($existsLesson)) {
            // continue lesson
            return $existsLesson;
        } else {
            // begin new lesson
            $createdLesson = $this->create([
                'user_id' => Auth::id(),
                'category_id' => $categoryId
            ]);

            return $createdLesson;
        }
    }

    /**
     * Return words that is not including already answered words
     *
     * @return object
     */
    public function remainingQuestions()
    {
        $alreadyAnswered = array_column($this->answers()->get()->toArray(), 'word_id');

        return $this->category()->first()->words()->whereNotIn('id', $alreadyAnswered);
    }

    /**
     * Save lesson answer
     *
     * @param integer $wordId
     * @param integer $choiceId
     * @return void
     */
    public function saveAnswer($wordId, $choiceId)
    {
        Answer::create([
            'lesson_id'          => $this->id,
            'word_id'            => $wordId,
            'selected_choice_id' => $choiceId
        ]);
    }
}
