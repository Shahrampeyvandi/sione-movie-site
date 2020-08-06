<?php

namespace App\Http\Controllers\Panel;

use Goutte;
use App\Post;
use App\Actor;
use App\Caption;
use App\Image;
use App\Video;
use App\Writer;
use App\Episode;
use App\Quality;
use App\Category;
use App\Director;
use App\Language;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image as ImageInvention;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class MoviesController extends Controller
{

    function MoviesList(Request $request)
    {

        $movies = Post::where('type', 'movies')->latest()->get();


        return view('Panel.Movies.List', compact(['movies']));
    }



    public function Add()
    {



        $actors = Actor::all();
        $writers = Writer::all();
        $directors = Director::all();
        $languages = Language::all();

        return view('Panel.Movies.add', compact(['writers', 'directors', 'actors', 'languages']));
    }



    public function Save(Request $request)
    {


        $slug = Str::slug($request->name);
        $destinationPath = "files/movies/$slug";
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        // if ($request->hasFile('poster')) {
        //     $picextension = $request->file('poster')->getClientOriginalExtension();
        //     $fileName = 'poster_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
        //     $request->file('poster')->move(public_path($destinationPath), $fileName);
        //     $Poster = "$destinationPath/$fileName";
        //     $img = ImageInvention::make(public_path($Poster))->resize(1900, 900)->save(public_path('1920-900/' . $fileName));
        // } else {
        //     if (isset($request->imdbposter) && $request->imdbposter) {
        //         $img = $destinationPath . '/poster_' . basename($request->imdbposter);

        //         file_put_contents($img, file_get_contents($request->imdbposter));
        //         $Poster = $img;
        //     } else {
        //         $Poster = Setting::first()->default_poster;
        //     }
        // }


        if (!File::exists($destinationPath)) {

            File::makeDirectory($destinationPath, 0777, true);
        }
        $post = new Post;
        $post->post_author = Auth::guard('admin')->user()->id;
        $post->title = $request->title;
        $post->name = $request->name;
        $post->slug = $slug;
        $post->type = 'movies';
        $post->description = $request->desc;
        $post->short_description = $request->short_desc;
        $post->imdbID = $request->imdbID;
        $post->imdbRating = $request->imdbRating;
        $post->imdbVotes = $request->imdbVotes;

        if ($request->hasFile('poster')) {
            $picextension = $request->file('poster')->getClientOriginalExtension();
            $fileName = 'poster_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $request->file('poster')->move(public_path($destinationPath), $fileName);
            $Poster = "$destinationPath/$fileName";
            $img = ImageInvention::make(public_path($Poster))->resize(320, 240)->insert('public/resizes/' . $Poster);
        } else {
            if (isset($request->imdbposter) && $request->imdbposter) {
                $img = $destinationPath . '/poster_' . basename($request->imdbposter);
                file_put_contents($img, file_get_contents($request->imdbposter));
                $Poster = $img;
            } else {
                $setting = Setting::first();
                if($setting) {

                   $Poster = $setting->default_poster;
                }else{
                    $Poster = '';
                }
                
            }
        }
        $post->released = Carbon::parse($request->released)->toDateTimeString();
        $post->year = Carbon::parse($request->released)->format('Y');
        $post->poster = $Poster;
        $post->duration = $request->duration;
        $post->age_rate = $request->age_rate;
        $post->awards = $request->awards;
        $post->comment_status = isset($request->commentstatus) && $request->commentstatus == '1' ? 'enable' : 'disable';

        if ($post->save()) {

            if ($request->has('checkImdb') && $request->checkImdb == "on") {

                if ($request->has('images')) {
                    if (!File::exists($destinationPath . "/images")) {
                        File::makeDirectory($destinationPath . "/images", 0777, true);
                    }
                    foreach ($request->images as $key => $image) {
                        $img = $destinationPath . "/images/" . basename($image);
                        file_put_contents($img, file_get_contents($image));
                        $post->images()->create([
                            'url' => $img,
                        ]);
                    }
                }
            } else {

                if ($request->has('images')) {
                    if (!File::exists($destinationPath . "/images")) {
                        File::makeDirectory($destinationPath . "/images", 0777, true);
                    }
                    foreach ($request->images as $key => $image) {

                        $picextension = $image->getClientOriginalExtension();
                        $fileName = 'image_' . date("Y-m-d") . '_' . time() . $key . '.' . $picextension;
                        $image->move($destinationPath . "/images/", $fileName);
                        $imageUrl = "$destinationPath/images/$fileName";
                        $post->images()->create([
                            'url' => $imageUrl,
                        ]);
                    }
                }
            }

            if (isset($request->trailer)) {
                $post->trailer()->create([
                    'name' => $post->name,
                    'poster' => '',
                    'url' => $request->trailer
                ]);
            }

            foreach ($request->categories as $key => $category) {
                if ($id = Category::check($category)) {
                    $post->categories()->attach($id);
                }
            }


            if (isset($request->actors)) {
                foreach ($request->actors as $key => $actor) {
                    if ($id = Actor::check($actor)) {
                        $post->actors()->attach($id);
                    } else {

                        $post->actors()->create(['name' => $actor]);
                    }
                }
            }
            if (isset($request->directors)) {
                foreach ($request->directors as $key => $director) {
                    if ($id = Director::check($director)) {
                        $post->directors()->attach($id);
                    } else {
                        $post->directors()->create(['name' => $director]);
                    }
                }
            }
            if (isset($request->writers)) {
                foreach ($request->writers as $key => $writer) {
                    if ($id = Writer::check($writer)) {
                        $post->writers()->attach($id);
                    } else {
                        $post->writers()->create(['name' => $writer]);
                    }
                }
            }
            if (isset($request->languages)) {
                foreach ($request->languages as $key => $language) {
                    if ($id = Language::check($language)) {
                        $post->languages()->attach($id);
                    } else {
                        $post->languages()->create(['name' => $language]);
                    }
                }
            }




            foreach ($request->file as $key => $file) {
                if ($id = Quality::check($file[2])) {
                    $quality_id = $id;
                } else {
                    $quality = Quality::create(['name' => $file[2]]);
                    $quality_id = $quality->id;
                }
                $video = $post->videos()->create([
                    'url' => $file[1],
                    'quality_id' => $quality_id
                ]);
            }

            if (isset($request->captions)) {
             $this->SaveCaption($request ,$post, $destinationPath);
            }
        } else {
            return back();
        }
        toastr()->success('پست با موفقیت ثبت شد');
        return Redirect::route('Panel.MoviesList', ['id' => $post->id]);
    }

    public function Edit(Post $post)
    {


        return view('Panel.Movies.add', compact(['post']));
    }



    public function AddEpisode()
    {
        $id = request()->id;
        if ($id) {
            $post = Post::find($id);
            $episodes = $post->episodes;
        } else {
            $episodes = [];
            $post = null;
        }
        return view('Panel.Files.AddEpisode', compact(['id', 'episodes', 'post']));
    }

    public function SaveEpisode(Request $request)
    {

        $post = Post::find($request->post);
        if (request()->hasFile('thumb')) {
            $destinationPath = 'files/series/thumbs';
            $picextension = request()->file('thumb')->getClientOriginalExtension();
            $fileName = $post->name . '-' . $request->season . '-' . $request->section . date("Y-m-d") . '_' . time() . '.' . $picextension;
            request()->file('thumb')->move($destinationPath, $fileName);
            $thumb = "$destinationPath/$fileName";
        } else {
            $thumb = '';
        }

        $episode = $post->episodes()->create([
            'name' => $request->name,
            'duration' => '00',
            'description' => $request->description,
            'poster' => $thumb,
            'season' => $request->season,
            'section' => $request->section,
        ]);

        return Redirect::route('Panel.UploadVideo', ['id' => $post->id, 'episode' => $episode->id]);
    }

    public function EditMovie(Request $request, Post $post)
    {


       
        $slug = Str::slug($post->name);
        $destinationPath = "files/movies/$slug";
        if ($request->hasFile('poster')) {
            File::delete(public_path() . $post->poster);
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true);
            }
            $picextension = $request->file('poster')->getClientOriginalExtension();
            $fileName = 'poster_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $request->file('poster')->move($destinationPath, $fileName);
            $Poster = "$destinationPath/$fileName";
        } else {
            $Poster = $post->poster;
        }

        $post->post_author = Auth::guard('admin')->user()->id;
        $post->title = $request->title;
        $post->name = $request->name;
        $post->type = 'movies';
        $post->description = $request->desc;
        $post->short_description = $request->short_desc;
        $post->imdbID = $request->imdbID;
        $post->imdbRating = $request->imdbRating;
        $post->imdbVotes = $request->imdbVotes;
        $post->released = Carbon::parse($request->released)->toDateTimeString();



        $post->poster = $Poster;
        $post->duration = $request->duration;
        $post->age_rate = $request->age_rate;
        $post->awards = $request->awards;
        $post->comment_status = isset($request->commentstatus) && $request->commentstatus == '1' ? 'enable' : 'disable';

        $post->update();


        if ($request->has('imdbImages')) {
            $array_images = $post->images()->pluck('url');
            foreach ($array_images as $image) {
                if (!in_array($image, $request->imdbImages)) {
                    File::delete(public_path($image));
                    $image = Image::where('url', $image)->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->images as $key => $image) {
                $picextension = $image->getClientOriginalExtension();
                $fileName = 'image_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
                $image->move(public_path($destinationPath . "/images"), $fileName);
                $imageUrl = "$destinationPath/images/$fileName";
                $post->images()->create([
                    'url' => $imageUrl,
                ]);
            }
        }

        if (isset($request->trailer)) {
            if ($post->trailer) {
                $post->trailer()->update([
                    'name' => $post->name,
                    'poster' => '',
                    'url' => $request->trailer
                ]);
            } else {
                $post->trailer()->create([
                    'name' => $post->name,
                    'poster' => '',
                    'url' => $request->trailer
                ]);
            }
        }

        foreach ($request->categories as $key => $category) {
            if ($post->categories()->pluck('name')->contains($category)) {
                continue;
            }

            if ($id = Category::check($category)) {
                $post->categories()->attach($id);
            }
        }


        foreach ($request->actors as $key => $actor) {
            if ($post->actors()->pluck('name')->contains($actor)) {
                continue;
            }
            if ($id = Actor::check($actor)) {
                $post->actors()->attach($id);
            } else {

                $post->actors()->create(['name' => $actor]);
            }
        }

        foreach ($request->directors as $key => $director) {
            if ($post->directors()->pluck('name')->contains($director)) {
                continue;
            }
            if ($id = Director::check($director)) {
                $post->directors()->attach($id);
            } else {

                $post->directors()->create(['name' => $director]);
            }
        }

        foreach ($request->writers as $key => $writer) {
            if ($post->writers()->pluck('name')->contains($writer)) {
                continue;
            }
            if ($id = Writer::check($writer)) {
                $post->writers()->attach($id);
            } else {

                $post->writers()->create(['name' => $writer]);
            }
        }

        foreach ($request->languages as $key => $language) {
            if ($post->languages()->pluck('name')->contains($language)) {
                continue;
            }
            if ($id = Language::check($language)) {

                $post->languages()->attach($id);
            } else {

                $post->languages()->create(['name' => $language]);
            }
        }


        $videos = $post->videos();
        foreach ($videos as $key => $video) {
            $video->captions()->delete();
        }
        $videos->delete();



        foreach ($request->file as $key => $file) {
            if ($file[1] !== null) {
                if ($id = Quality::check($file[2])) {
                    $quality_id = $id;
                } else {
                    $quality = Quality::create(['name' => $file[2]]);
                    $quality_id = $quality->id;
                }


                $video = $post->videos()->create([
                    'url' => $file[1],
                    'quality_id' => $quality_id
                ]);

               
            }
        }

         if (isset($request->captions)) {
             $this->SaveCaption($request ,$post, $destinationPath);
            }

        toastr()->success('پست با موفقیت ویرایش شد');
        return Redirect::route('Panel.MoviesList');
    }

    public function DeletePost(Request $request)
    {


        $post = Post::find($request->post_id);
        File::delete(public_path() . $post->poster);
        if ($post->trailer) {
            File::delete(public_path() . $post->trailer->url);
        }
        foreach ($post->images as $key => $obj) {
            File::delete(public_path() . $obj->url);
        }

        if ($post->type == 'series') {
            foreach ($post->seasons as $key => $season) {
                foreach ($season->sections as $key => $section) {
                    foreach ($section->videos as $key => $video) {
                        $video->captions()->delete();
                    }
                    $section->videos()->delete();
                }

                $season->sections()->delete();

                $season->delete();
            }
        }
        $post->delete();

        toastr()->success('پست با موفقیت حذف شد');
        return back();
    }

    public function DeleteVideo(Request $request)
    {

        $video = Video::find($request->id);
        File::delete(public_path() . $video->url);
        foreach ($video->captions as $key => $caption) {
            $caption->delete();
        }
        $video->delete();
        return response()->json('ویدیو با موفقیت حذف شد');
    }

    public function DeleteImage(Request $request)
    {
        $image = Image::find($request->id);
        File::delete(public_path() . $image->url);
        $image->delete();
        return response()->json('تصویر با موفقیت حذف شد');
    }


    public function AddCatAjax(Request $request)
    {

        $cat = new Category;
        $cat->name = $request->name;
        $cat->latin = ucwords(strtolower($request->latin));
        $cat->save();

        return 'true';
    }


    public function checkNameAjax(Request $request)
    {
        // check in db
        if (Post::where('name', $request->name)->count()) {
            return response()->json(['error' => 'این مورد از قبل ثبت شده است']);
        }
    }

    public function DeleteCaption(Request $request)
    {
        $caption = Caption::find($request->id);
        File::delete(public_path() . $caption->url);
        $caption->delete();
         return response()->json('success',200);
    }
}

