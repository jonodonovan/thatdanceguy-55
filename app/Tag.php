<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    public function events()
    {
        return $this->belongsToMany('App\Event');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
