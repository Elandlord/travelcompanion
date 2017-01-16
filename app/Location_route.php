<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location_route extends Model
{
    protected $fillable = [
        'location_id', 
        'route_id', 
        'arrival_date',
        'departure_date', 
    ];

    public function routes()
    {
    	return $this->hasMany('App\Models\Route');
    }

    public function locations()
    {
    	return $this->hasMany('App\Models\Location');
    }
}
