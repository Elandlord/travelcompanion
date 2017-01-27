<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel_user extends Model
{
    protected $table = 'hotel_user';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
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
    	return $this->belongsTo('App\User');
    }

    public function hotels()
    {
    	return $this->hasMany('App\Hotel');
    }
}
