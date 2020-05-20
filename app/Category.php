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

    public function isAlreadyLearned($userId)
    {
        if ($this->lessons()->where('user_id', $userId)->count() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
