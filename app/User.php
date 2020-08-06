<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    public function planStatus()
    {
        $plans =  $this->plans;
        $plan = $this->plans()->wherePivot('expire_date', '>', \Carbon\Carbon::now())
            ->first();
        if ($plan) {
            return true;
        } else {
            return false;
        }
    }

    public function noty()
    {
        return $this->hasMany(Notification::class,'reciver_id');
    }

     public function newNoty()
    {
      return $new = Notification::where('reciver_id',$this->id)->whereDate('created_at', '=' , \Carbon\Carbon::today())->count();
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
