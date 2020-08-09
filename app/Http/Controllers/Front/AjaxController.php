<?php

namespace App\Http\Controllers\Front;

use App\Discount as AppDiscount;
use App\Plan;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Discount;
use Illuminate\Database\Eloquent\Collection;

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
        if ($plan) {
            $discount = $plan->discounts->where('d_code', $request->code);

            if (count($discount)) {

                $amount = ($plan->priceWithDiscount() * $discount->first()->percent) / 100;
                session()->put('discount' . $user->id, $amount);
                session()->put('amount' . $user->id, $plan->priceWithDiscount() - $amount);
                return response()->json(session()->get('amount' . $user->id), 200);
            }
        }
    }



    public function Search(Request $request)
    {

        $cat = [];
        $caption = [];
        $year = [];
        
        // dd($request->data);
        if ($request->data) {


            foreach ($request->data as $key => $data) {
                if ($data['type'] == 'word') {

                    $word = $data['key'];
                   
                } else {
                    $word = null;
                }
            }


            foreach ($request->data as $key => $data) {
                if ($data['type'] == 'genre') {
                    $cat[] = $data['id'];
                }
            }
            foreach ($request->data as $key => $data) {
                if ($data['type'] == 'caption') {
                    $caption[] = $data['id'];
                }
            }
            foreach ($request->data as $key => $data) {
                if ($data['type'] == 'year') {
                    $year[] = $data['year'];
                }
            }
            foreach ($request->data as $key => $data) {
                if ($data['type'] == 'order') {
                    $order = $data['name'];
                }
            }

            // dd($order);
            // dd([explode(';',$year[0])[0],explode(';',$year[0])[1]]);
            // dd([$cat, $caption, $year]);
            if ($word !== null) {
                $posts = Post::where('name', 'like', '%' . $word . '%')
                ->orWhere('title', 'like', '%' . $word . '%')
                    ->orWhereHas('actors', function ($q) use ($word) {
                        $q->where('name', 'like', '%' . $word . '%');
                    })->get();
                    
            } else {


                if (count($cat) > 0 && count($caption) > 0 && count($year) > 0) {

                    $posts = Post::whereHas('categories', function ($q) use ($cat) {
                        $q->whereIn('id', $cat);
                    })->whereHas('categories', function ($q) use ($cat) {
                        $q->whereIn('id', $cat);
                    })->whereBetween('year', [explode(';', $year[0])[0], explode(';', $year[0])[1]])->get();
                } elseif (count($cat) > 0 && count($caption)) {
                    $posts = Post::whereHas('categories', function ($q) use ($cat) {
                        $q->whereIn('id', $cat);
                    })->whereHas('captions', function ($q) use ($caption) {
                        $q->whereIn('lang', $caption);
                    })->get();
                } elseif (count($cat) > 0) {
                    $posts = Post::whereHas('categories', function ($q) use ($cat) {
                        $q->whereIn('id', $cat);
                    })->get();
                } elseif (count($caption) > 0) {
                    $posts = Post::whereHas('captions', function ($q) use ($caption) {
                        $q->whereIn('lang', $caption);
                    })->get();
                } elseif (count($year) > 0) {
                    $posts = Post::whereBetween('year', [explode(';', $year[0])[0], explode(';', $year[0])[1]])->get();
                }



                if ($order !==  'default') {
                    if ($order == 'new') {

                        $posts = $posts->sortBy('created_at');
                    }
                    if ($order == 'rate') {

                        $posts = $posts->sortBy('imdbRating');
                    }
                    if ($order == 'yearasc') {

                        $posts = $posts->sortBy('year');
                    }
                    if ($order == 'yeardsc') {

                        $posts = $posts->sortByDesc('year');
                    }
                }
            }



            $articles = $this->createArticles($posts);

            return response()->json($articles, 200);
        }
    }

    public function createArticles($posts)
    {
        $article = '';
        foreach ($posts as $key => $post) {


            $article .= '
             <div class="col-6 col-md-3 col-lg-2">
    <a href="' . $post->path() . '" data-id="1" >
        <div class="movie-sections-box">
            <div class="img-box-movies">
                <img src="' . asset($post->poster) . '" alt="' . $post->name . '">
                <div class="cover-img-movies-details">
                    <span>
                        ' . $post->name . ' -';
            if ($post->type == 'series') {

                $article .= \Morilog\Jalali\Jalalian::forge($post->first_publish_date)->format('%Y');
            } else {

                $article .= \Morilog\Jalali\Jalalian::forge($post->released)->format('%Y');
            }

            $article .= '</span>
                    <span>
                        <i class="fa fa-heart"></i>
                        89%
                    </span>
                </div>
            </div>
            <h5>
                ' . $post->title . '
            </h5>
        </div>
    </a></div>';
        }
        return $article;
    }
}
