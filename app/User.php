<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo_link',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function routes()
    {
        return $this->hasMany('App\Route');
    }

    
    public function hotels()
    {
        return $this->belongsToMany('App\Hotel')
            ->withPivot('arrival_date')
            ->withPivot('departure_date')
            ->withPivot('price')
            ->withPivot('amount_persons')
            ->withPivot('paid')
            ->withPivot('bank_account_number');
    }

}
