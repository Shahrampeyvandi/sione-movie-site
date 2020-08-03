<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Slider;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function All()
    {
        $categories = Category::all();
        return view('Front.Categories', ['categories' => $categories]);
    }

    public function Show(Request $request, $name)
    {
        $category = Category::where('latin', $name)->first();
        if ($category) {
            $sliders = Slider::withCategory($name);
            $data['sliders'] = $sliders;
            $data['title'] = $name ;
            return view('Front.index', $data);
        } else {
            abort(404);
        }
    }
}
