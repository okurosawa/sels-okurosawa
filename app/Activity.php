<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['user_id', 'activity_id', 'activity_type'];

    public function activity_morph()
    {
        return $this->morphTo('activity');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
