<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use SoftDeletes;

    protected $fillable = ['category_id', 'content'];

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }
}
