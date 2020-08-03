<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Slider;
use Carbon\Carbon;

class MainController extends Controller
{
    public function index()
    {
      
        $year = Carbon::now()->year();
        $newSeries = Post::where('type','series')->latest()->take(10)->get();
        $newyear = Post::where('year',$year)->latest()->take(10)->get();
        $latestdoble = Post::whereHas('categories',function($q){
            $q->where('name','دوبله فارسی');
        })->latest()->take(10)->get();

        $sliders = Slider::latest()->get();

        $data['newseries'] = $newSeries;
        $data['latestdoble'] = $latestdoble;
        $data['newyear'] = $newyear;
        $data['year'] = $year;
        $data['sliders'] = $sliders;
        $data['title'] = 'صفحه اصلی';
        return view('Front.index',$data);
    }
}
