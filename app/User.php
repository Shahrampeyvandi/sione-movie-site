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

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function type()
    {
        return $this->role == 'مشترک' ? 'moshtarak' : '';
    }
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'user_plan', 'user_id', 'plan_id')->withPivot('expire_date');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
