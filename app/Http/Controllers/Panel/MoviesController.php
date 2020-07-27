<?php

namespace App\Http\Controllers\Panel;

use Goutte;
use App\Post;
use App\Actor;
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

use App\Http\Controllers\Controller;
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


        // $p = [2,3,4,5,6,7,8,9];
        // $crawler = \Goutte::request('GET', 'https://www.imdb.com/list/ls008774465/?sort=list_order,asc&mode=detail&page=10');
        // $crawler->filter('.lister-item')->each(function ($node) {

        //     $url = $node->filter('.lister-item-image img')->attr('src');
        //     $img = public_path('/directors/') . basename($url);
        //     file_put_contents($img, file_get_contents($url));

        //     DB::table('directors')->insert([
        //         'name' => $node->filter('.lister-item-header a')->text(),
        //         'image' => "directors/" . basename($url),
        //         'bio' => null,
        //     ]);

        // });
        // dd('sd');
        $actors = Actor::all();
        $writers = Writer::all();
        $directors = Director::all();
        $languages = Language::all();

        return view('Panel.Movies.add', compact(['writers', 'directors', 'actors', 'languages']));
    }



    public function Save(Request $request)
    {

        // dd($request->all());
        $slug = Str::slug($request->name);
        $destinationPath = "files/movies/$slug";
        if (!File::exists($destinationPath)) {

            File::makeDirectory($destinationPath, 0777, true);
        }
        $post = new Post;
        $post->post_author = Auth::guard('admin')->user()->id;
        $post->title = $request->title;
        $post->name = $request->name;
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
        } else {
            if (isset($request->imdbposter) && $request->imdbposter) {
                $img = $destinationPath . '/poster_' . basename($request->imdbposter);
                file_put_contents($img, file_get_contents($request->imdbposter));
                $Poster = $img;
            } else {
                $Poster = '';
            }
        }
        $post->released = Carbon::parse($request->released)->toDateTimeString();

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


            foreach ($request->actors as $key => $actor) {
                if ($id = Actor::check($actor)) {
                    $post->actors()->attach($id);
                } else {

                    $post->actors()->create(['name' => $actor]);
                }
            }

            foreach ($request->directors as $key => $director) {
                if ($id = Director::check($director)) {
                    $post->directors()->attach($id);
                } else {

                    $post->directors()->create(['name' => $director]);
                }
            }

            foreach ($request->writers as $key => $writer) {
                if ($id = Writer::check($writer)) {
                    $post->writers()->attach($id);
                } else {

                    $post->writers()->create(['name' => $writer]);
                }
            }

            foreach ($request->languages as $key => $language) {
                if ($id = Language::check($language)) {
                    $post->languages()->attach($id);
                } else {

                    $post->languages()->create(['name' => $language]);
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

                foreach ($file[3] as $key => $caption) {
                    if (array_key_exists(2, $caption)) {
                        $video->captions()->create(['lang' => $caption[1], 'url' => $caption[2]]);
                    }
                }
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


        // dd($request->all());
        if ($request->hasFile('poster')) {
            File::delete(public_path() . $post->poster);
            $slug = Str::slug($post->name);
            $destinationPath = "files/movies/$slug";
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

                foreach ($file[3] as $key => $caption) {
                    if (array_key_exists(2, $caption)) {
                        $video->captions()->create(['lang' => $caption[1], 'url' => $caption[2]]);
                    }
                }
            }
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
}
