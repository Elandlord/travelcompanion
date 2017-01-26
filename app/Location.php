<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $timestamps = false;

   protected $fillable = [
        'id',
        'name', 
        'country',
    ];

    public function routes()
    {
        return $this->belongsToMany('App\Route')
            ->withPivot('arrival_date')
            ->withPivot('departure_date');
    }
}
