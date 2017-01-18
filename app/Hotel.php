<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id', 
        'description', 
        'name',
        'road_name', 
        'house_number', 
        'phone_number',
        'email_address', 
        'zip_code', 
    ];

    public function routes()
    {
        return $this->belongsToMany('App\Route');
    }
}
