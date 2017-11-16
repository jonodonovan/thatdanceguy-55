<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    /**
    * Override parent boot and Call deleting event
    *
    * @return void
    */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($venues) {
            foreach ($venues->events()->get() as $event) {
                $event->delete();
            }
        });
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
