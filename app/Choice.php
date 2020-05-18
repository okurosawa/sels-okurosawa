<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choice extends Model
{
    use SoftDeletes;

    protected $fillable = ['word_id', 'content', 'correct_answer_flag'];
}
