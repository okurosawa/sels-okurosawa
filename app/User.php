<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'avatar_path', 'admin_flag',
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

    /**
     * Update User Profile
     *
     * @param object $data
     * @return void
     */
    public function updateProfile($data)
    {
        $avatar = null;

        if ($data->hasFile('avatar') && $data->file('avatar')->isValid()) {
            $mimeType = $data->file('avatar')->getClientMimeType();
            $encodedImage = base64_encode(file_get_contents($data->file('avatar')->getRealPath()));
            $avatar = 'data:' . $mimeType . ';base64,' . $encodedImage;
        }

        $this->update([
            'first_name'  => $data->first_name ?: $this->first_name,
            'last_name'   => $data->last_name ?: $this->last_name,
            'email'       => $data->email ?: $this->email,
            'password'    => $data->new_password ? Hash::make($data->new_password) : $this->password,
            'avatar_path' => $avatar ?: $this->avatar_path
        ]);
    }
}
