<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class AjaxController extends Controller
{
    public function getMovieDetail(Request $request)
    {
        
        $post = Post::find($request->id);
        if($post) {
            return response()->json([
                'poster'=>asset($post->poster),
                'title' => $post->title,
                'desc' => $post->description,
                'path' => $post->path()
        ],200);
        }
    }
}
