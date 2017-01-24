<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location_route extends Model
{
    protected $table = 'location_route';
    public $timestamps = false;

    protected $fillable = [
        'location_id', 
        'route_id', 
        'arrival_date',
        'departure_date', 
    ];

    public function routes()
    {
    	return $this->hasMany('App\Route');
    }

    public function locations()
    {
    	return $this->hasMany('App\Location');
    }
}
