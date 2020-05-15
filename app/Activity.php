<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['user_id', 'activity_id', 'activity_type'];

    public function activityMorph()
    {
        return $this->morphTo('activity');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Log the activity when user change something.
     * 
     * $userId is ID of User who log the activity.
     * $activityId is ID of Model what user changed is.
     * $model is string of Model like this, "App\User"
     *
     * @param integer $userId
     * @param integer $activityId
     * @param string $model
     * @return void
     */
    public function logActivity($userId, $activityId, $model)
    {
        $this->create([
            'user_id'       => $userId,
            'activity_id'   => $activityId,
            'activity_type' => $model
        ]);
    }
}
