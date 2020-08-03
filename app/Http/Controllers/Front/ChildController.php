<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChildController extends Controller
{
    public function Show()
    {
        $posts  =  Post::withCategory('Animation');
        $sliders = Slider::withCategory('Animation');
        $data['sliders'] = $sliders;
        $data['posts'] = $posts;
        $data['title'] = 'کودک';

        return view('Front.index', $data);
    }
}
