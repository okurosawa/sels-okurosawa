<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['lesson_id', 'word_id', 'selected_choice_id'];

    public function choice()
    {
        return $this->belongsTo('App\Choice', 'selected_choice_id');
    }
}
