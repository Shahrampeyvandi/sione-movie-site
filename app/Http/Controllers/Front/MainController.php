<?php

namespace App\Http\Controllers\Front;

use App\Episode;
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
        $newSeries = Post::where('type', 'series')->latest()->take(10)->get();
        $newyear = Post::where('year', $year)->latest()->take(10)->get();
        $latestdoble = Post::whereHas('categories', function ($q) {
            $q->where('name', 'دوبله فارسی');
        })->latest()->take(10)->get();

        $sliders = Slider::latest()->get();

        $data['newseries'] = $newSeries;
        $data['latestdoble'] = $latestdoble;
        $data['newyear'] = $newyear;
        $data['year'] = $year;
        $data['sliders'] = $sliders;
        $data['title'] = 'صفحه اصلی';
        return view('Front.index', $data);
    }

    public function Play()
    {
        if(auth()->check() && auth()->user()->planStatus()){

    
        $model = Post::where('slug', request()->slug)->first();
        if (!$model) {
            abort(404);
        }

        if ($model->type == 'movies') {
            $post = $model;
            $videos = $model->videos;
           
            
            if (count($videos) == 0) {
                return back();
            }
        }
        if ($model->type == 'series') {
            $season = $model->seasons->where('name', request()->season)->first();
            if (!$season) {
                abort(404);
            }
            $post = $season->sections->where('section', request()->section)->first();
            if (!$post) {
                abort(404);
            }
            $videos = $post->videos;
        }
        

        
        return view('Front.play', compact(['videos', 'post']));
    }else{
        return redirect()->route('S.SiteSharing');
    } 
    }

    public function DownLoad($id)
    {
       if(auth()->check() && !auth()->user()->planStatus()){
           return response()->json([
               'data' => 'error',
               'redirect' => route('S.SiteSharing') 
           ]);
       }
        $post = Post::find($id);
        $url = $post->videos->first()->url;
        $path      = parse_url($url, PHP_URL_PATH);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $filename  = pathinfo($path, PATHINFO_FILENAME);
        $filename = $post->slug . '.' . $extension;
        header("Content-disposition:attachment; filename=$filename");
        readfile($url);

        // $tempImage = tempnam(sys_get_temp_dir(), $filename);
        // copy($url, $tempImage);
        // return response()->download($tempImage, $filename);
    }
}
