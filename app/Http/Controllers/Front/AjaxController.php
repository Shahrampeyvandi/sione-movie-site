<?php

namespace App\Http\Controllers\Front;

use App\Discount as AppDiscount;
use App\Plan;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Discount;

class AjaxController extends Controller
{
    public function getMovieDetail(Request $request)
    {

        $post = Post::find($request->id);

        if ($post) {
            if ($post->type == 'movies') {
                return response()->json([
                    'type' => 'movies',
                    'poster' => asset($post->poster),
                    'title' => $post->title,
                    'desc' => $post->description,
                    'path' => $post->path(),
                    'play' => $post->play(),
                    'download' => $post->downloadpath()
                ], 200);
            }
            if ($post->type == 'series') {
                return response()->json([
                    'type' => 'series',
                    'poster' => asset($post->poster),
                    'title' => $post->title,
                    'desc' => $post->description,
                    'path' => $post->path(),
                ], 200);
            }
        }
    }

    public function checkTakhfif(Request $request)
    {
        $user = auth()->user();

        
        $plan = Plan::whereId($request->plan_id)->first();
        if($plan) {
            $discount = $plan->discounts->where('d_code',$request->code);

            if(count($discount)){

                $amount = ($plan->priceWithDiscount() * $discount->first()->percent) / 100;
                session()->put('discount'.$user->id , $amount );
                 session()->put('amount'.$user->id ,$plan->priceWithDiscount() - $amount);
                 return response()->json(session()->get('amount'.$user->id),200);
                
            }
            
        }
        
   
    }
}
