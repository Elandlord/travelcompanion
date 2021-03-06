<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'user_id', 
        'departure_date', 
        'return_date',
    ];

    public function locations()
    {
        return $this->belongsToMany('App\Location')
            ->withPivot('arrival_date')
            ->withPivot('departure_date');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
