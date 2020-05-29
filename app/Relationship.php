<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = ['follower_id', 'following_id'];

    public function activities()
    {
        return $this->morphMany('App\Activity', 'activity');
    }

    public function followingUser()
    {
        return $this->belongsTo('App\User', 'following_id')->withTrashed();
    }
}
