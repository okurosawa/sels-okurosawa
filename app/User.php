<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function answers()
    {
        return $this->hasManyThrough(
            'App\Answer',
            'App\Lesson',
            'user_id',
            'lesson_id'
        );
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function is_following($following_id)
    {
        if ($this->following()->where('following_id', $following_id)->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'relationships', 'following_id', 'follower_id')->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'relationships', 'follower_id', 'following_id')->withTimestamps();
    }
}
