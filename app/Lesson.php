<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
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
}
