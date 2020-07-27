<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded  = [
        'id'
    ];

   

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_user', 'user_id', 'plan_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
   
   

   
}
