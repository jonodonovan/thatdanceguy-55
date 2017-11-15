<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at', 'startdatetime', 'enddatetime'];

    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
