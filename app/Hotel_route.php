<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel_route extends Model
{
    protected $table = 'hotel_route';
    public $timestamps = false;

    protected $fillable = [
        'route_id',
        'hotel_id', 
        'arrival_date', 
        'departure_date',
        'price', 
        'amount_persons', 
        'paid',
        'bank_account_number', 
    ];

    public function routes()
    {
    	return $this->belongsTo('App\Route');
    }

    public function hotels()
    {
    	return $this->hasMany('App\Hotel');
    }
}
