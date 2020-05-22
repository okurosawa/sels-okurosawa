<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description'];

    public function words()
    {
        return $this->hasMany('App\Word');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function howManyRemainingWords($userId)
    {
        $lesson = $this->lessons()->where('user_id', $userId)->first();

        if (isset($lesson)) {
            return $this->words()->count() - $lesson->answers()->count();
        }

        return $this->words()->count();
    }
}
