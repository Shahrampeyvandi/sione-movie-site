<?php

namespace App\Http\Controllers\Front;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
  
    function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function All()
    {
        $data['title'] = 'خرید اشتراک';
        return view('Front.Plans',$data);
    }

    public function Buy(Request $request)
    {
        
       $plan = Plan::whereName($request->plan_name)->first();
       if($plan) {
           $expire_date = Carbon::now()->addDays($plan->days);
        $user = auth()->user();
        $user->plans()->attach($plan->id,['expire_date'=>$expire_date]);


        // send sms 


        return redirect()->route('MainUrl');
       }else{
           return back();
       }
    }
}
