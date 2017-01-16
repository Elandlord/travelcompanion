<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
   protected $fillable = [
        'location_id', 
        'name', 
        'country',
    ];

    public function routes()
    {
        return $this->belongsToMany('App\Route');
    }
}
