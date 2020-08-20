<?php

namespace App\Http\Controllers\Blog;

use App\Plan;
use App\Post;
use App\Mail\Discount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Discount as AppDiscount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use App\Blog;
use App\BlogCategory;

class BlogController extends Controller
{
    public function index(){

        $last6blogs=Blog::latest()->take(5);


        return view('blog.index');
    }

    public function show($id){

        $post=Blog::find($id);

        $categories=$post->categories;

        $relateds=[];
            foreach($categories as $category){
                $rbps=$category->blogs->where('id','!=',$post->id)->take(5);
                foreach($rbps as $rbp){
                    $relateds[]=$rbp;
                }
            }



        return view('blog.post',compact(['post','relateds']));
    }
    
    public function showvideo($id){


        return view('blog.movie');
    }
}