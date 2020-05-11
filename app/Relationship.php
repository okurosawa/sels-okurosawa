<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    public function activities()
    {
        return $this->morphMany('App\Activity', 'activity');
    }

    public function following_user()
    {
        return $this->belongsTo('App\User', 'following_id');
    }
}
