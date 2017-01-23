<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 
        'departure_date', 
        'return_date',
    ];

    public function hotels()
    {
        return $this->belongsToMany('App\Hotel');
    }

    public function locations()
    {
        return $this->belongsToMany('App\Location');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
