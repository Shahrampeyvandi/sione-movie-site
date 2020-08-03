<?php

namespace App\Http\Controllers\Panel;

use App\Post;
use App\Actor;
use App\Season;
use App\Writer;
use App\Episode;
use App\Quality;
use App\Section;
use App\Category;
use App\Director;
use App\Language;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class SeriesController extends Controller
{
    public function SeriesList(Request $request)
    {

        $series = Post::where('type', 'series')->latest()->get();
        return view('Panel.Series.List', compact(['series']));
    }

    public function Add()
    {

        $actors = Actor::all();
        $writers = Writer::all();
        $directors = Director::all();
        $languages = Language::all();

        return view('Panel.Series.add', compact(['writers', 'directors', 'actors', 'languages']));
    }

    public function Save(Request $request)
    {

        $slug = Str::slug($request->name);

        $destinationPath = "files/series/$slug";
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }

        $post = new Post;
        $post->post_author = Auth::guard('admin')->user()->id;
        $post->title = $request->title;
        $post->name = $request->name;
        $post->slug = $slug;
        $post->type = 'series';
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


        $post->first_publish_date = Carbon::parse($request->first_release)->toDateTimeString();
        $post->last_publish_date = Carbon::parse($request->last_release)->toDateTimeString();
        if ($request->last_release) {
            $post->year = Carbon::parse($request->last_release)->format('Y');
        } else {
            $post->year = Carbon::parse($request->first_release)->format('Y');
        }
        $post->poster = $Poster;
        $post->duration = $request->duration;
        $post->age_rate = $request->age_rate;
        $post->awards = $request->awards;
        $post->post_status = $request->serie_status;
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
                        $image->move($destinationPath . "/images", $fileName);
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
        } else {
            return back();
        }

        toastr()->success('سریال با موفقیت ثبت شد');
        return Redirect::route('Panel.SeriesList', ['id' => $post->id]);
    }


    public function Edit(Post $post)
    {
        return view('Panel.Series.add', compact(['post']));
    }

    public function EditSerie(Request $request, Post $post)
    {

        // dd($request->all());
        $slug = Str::slug($post->name);

        $destinationPath = "files/series/$slug";
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
        $post->type = 'series';
        $post->description = $request->desc;
        $post->short_description = $request->short_desc;
        $post->imdbID = $request->imdbID;
        $post->imdbRating = $request->imdbRating;
        $post->imdbVotes = $request->imdbVotes;
        $post->first_publish_date = Carbon::parse($request->first_release)->toDateTimeString();
        $post->last_publish_date = Carbon::parse($request->last_release)->toDateTimeString();



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


        if ($request->has('images')) {
            foreach ($request->images as $key => $image) {
                $picextension = $image->getClientOriginalExtension();
                $fileName = 'image_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
                $image->move($destinationPath . "/images", $fileName);
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






        toastr()->success('پست با موفقیت ویرایش شد');

        return Redirect::route('Panel.SeriesList');
    }

    public function InsertSeason(Request $request, $id)
    {


        $post = Post::find($id);
        $slug = Str::slug($post->name);
        $destinationPath = "files/series/$slug";
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        if ($request->hasFile('poster')) {
            $picextension = $request->file('poster')->getClientOriginalExtension();
            $fileName = 'season_' . $request->number . '_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $request->file('poster')->move(public_path($destinationPath), $fileName);
            $Poster = "$destinationPath/$fileName";
        } else {
            $Poster = '';
        }

        Season::create([
            'name' => $request->title,
            'number' => $request->number,
            'description' => $request->desc,
            'poster' => $Poster,
            'publish_date' => Carbon::parse($request->release)->toDateTimeString(),
            'post_id' => $request->serie
        ]);
        toastr()->success('فصل با موفقیت اضافه شد');

        return back();
    }


    public function EditSeason(Season $season)
    {
        $series = Post::where('type', 'series')->latest()->get();
        $seasons = Season::OrderBy('name', 'ASC')->get();

        return view('Panel.Series.season', compact(['series', 'seasons', 'season']));
    }


    public function EditSection(Episode $section)
    {


        $sections = Episode::OrderBy('name', 'ASC')->get();

        return view('Panel.Series.section', compact(['sections', 'section']));
    }

    public function SaveEditSeason(Request $request, Season $season)
    {



        $serie = $season->serie;
        $slug = Str::slug($serie->name);
        $destinationPath = "files/series/$slug";
        if ($request->hasFile('poster')) {
            File::delete(public_path() . '/' . $season->poster);
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true);
            }
            $picextension = $request->file('poster')->getClientOriginalExtension();
            $fileName = 'season_' . $request->number . '_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $request->file('poster')->move($destinationPath, $fileName);
            $Poster = "$destinationPath/$fileName";
        } else {
            $Poster = $season->poster;
        }
        $season->update([
            'name' => $request->title,
            'description' => $request->desc,
            'poster' => $Poster,
            'publish_date' => Carbon::parse($request->release)->toDateTimeString(),
        ]);
        toastr()->success('فصل با موفقیت ویرایش شد');
        return back();
    }
    public function SaveEditSection(Request $request, Episode $section)
    {

        $serie = $section->serie;
        // dd($section);

        if ($request->hasFile('poster')) {
            File::delete(public_path() . '/' . $section->poster);
            $slug = Str::slug($serie->name);
            $destinationPath = "files/series/$slug";
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true);
            }
            $picextension = $request->file('poster')->getClientOriginalExtension();
            $fileName = 'section_' . $request->number . '_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $request->file('poster')->move(public_path($destinationPath), $fileName);
            $Poster = "$destinationPath/$fileName";
        } else {
            $Poster = $section->poster;
        }


        Episode::whereId($section->id)->update([
            'name' => $request->title,

            'description' => $request->desc,
            'poster' => $Poster,
            'publish_date' => Carbon::parse($request->release)->toDateTimeString(),

        ]);



        $videos = $section->videos();
        foreach ($videos as $key => $video) {
            $video->captions()->delete();
        }
        $videos->delete();



        foreach ($request->file as $key => $file) {
            if ($id = Quality::check($file[2])) {
                $quality_id = $id;
            } else {
                $quality = Quality::create(['name' => $file[2]]);
                $quality_id = $quality->id;
            }


            $video = $section->videos()->create([
                'url' => $file[1],
                'quality_id' => $quality_id
            ]);

            foreach ($file[3] as $key => $caption) {
                if (array_key_exists(2, $caption)) {
                    $video->captions()->create(['lang' => $caption[1], 'url' => $caption[2], 'post_id' => $serie->id]);
                }
            }
        }


        toastr()->success('قسمت با موفقیت ویرایش شد');

        return back();
    }





    public function AddSection(Season $season)
    {


        $sections = $season->sections;
        $serie = $season->serie;
        $id = $serie->id;
        if ($serie->imdbID) {

            $url = 'http://www.omdbapi.com/?i=' . $serie->imdbID . '&Season=' . $season->number . '&apikey=72a95dff';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $result = json_decode($response);
            curl_close($ch); // Close the connection

            $title = $result->Title;
            $episodes = $result->Episodes;
        } else {
            $episodes = [];
            $title = null;
        }


        return view('Panel.Series.section', compact(['sections', 'season', 'title', 'episodes', 'id']));
    }

    public function InsertSection(Request $request)
    {

        $post = Post::find($request->serie);
        $slug = Str::slug($post->name);
        $destinationPath = "files/series/$slug";
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }


        if ($request->hasFile('poster')) {
            $picextension = $request->file('poster')->getClientOriginalExtension();
            $fileName = 'section_' . $request->number . '_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $request->file('poster')->move($destinationPath, $fileName);
            $Poster = "$destinationPath/$fileName";
        } elseif ($request->has('posterImdb') && $request->posterImdb !== null) {
            $img = $destinationPath . '/' . 'section_' . basename($request->posterImdb);
            file_put_contents($img, file_get_contents($request->posterImdb));
            $Poster = $img;
        } else {
            $Poster = '';
        }






        $episode =  Episode::create([
            'name' => $request->title,
            'description' => $request->desc,
            'duration' => $request->runtime,
            'poster' => $Poster,
            'publish_date' => Carbon::parse($request->release)->toDateTimeString(),
            'section' => $request->number,
            'season' => $request->season,
            'post_id' => $request->serie,
            'imdbID' => $request->imdbID,
            'imdbRating' => $request->imdbRating,


        ]);

        foreach ($request->file as $key => $file) {
            if ($id = Quality::check($file[2])) {
                $quality_id = $id;
            } else {
                $quality = Quality::create(['name' => $file[2]]);
                $quality_id = $quality->id;
            }
            $video = $episode->videos()->create([
                'url' => $file[1],
                'quality_id' => $quality_id
            ]);

            foreach ($file[3] as $key => $caption) {
                if (array_key_exists(2, $caption)) {
                    $video->captions()->create(['lang' => $caption[1], 'url' => $caption[2], 'post_id' => $post->id]);
                }
            }
        }



        toastr()->success('قسمت با موفقیت اضافه شد');

        return back();
    }


    public function GetSeriesAjax(Request $request)
    {

        $seasons = Season::where('post_id', $request->data)->latest()->get();

        return response()->json($seasons, 200);
    }

    public function DeleteSection(Request $request)
    {
        $section = Episode::find($request->section_id);
        File::delete(public_path() . $section->poster);
        foreach ($section->videos as $key => $video) {
            $video->captions()->delete();
        }
        $section->videos()->delete();
        $section->delete();
        toastr()->success('قسمت با موفقیت حذف شد');
        return back();
    }

    public function DeleteSeason(Request $request)
    {
        $season = Season::find($request->season_id);
        File::delete(public_path() . $season->poster);
        foreach ($season->sections as $key => $section) {
            foreach ($section->videos as $key => $video) {
                $video->captions()->delete();
            }
            $section->videos()->delete();
        }

        $season->sections()->delete();

        $season->delete();



        toastr()->success('فصل با موفقیت حذف شد');
        return back();
    }

    public function AddSeason($id)
    {
        // dd($id);
        $post = Post::find($id);
        if ($post->imdbID) {

            $dd = \L5Imdb::title($post->imdbID)->all();

            $totalSeasons = $dd['seasons'];
            $title = $dd['title'];
        } else {
            $totalSeasons = null;
            $title = null;
        }


        $seasons = $post->seasons;

        return view('Panel.Series.season', compact(['seasons', 'id', 'totalSeasons', 'title']));
    }


    public function getSectionImdbData(Request $request)
    {
        //    dd($request->all());


        $serie = Post::find($request->serieId);

        $url = 'http://www.omdbapi.com/?t=' . $serie->name . '&Season=' . $request->seasonNumber . '&Episode=' . $request->episode . '&apikey=72a95dff';
        $url = str_replace(' ', '%20', $url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $result = json_decode($response);
        curl_close($ch); // Close the connection

        $array['title'] = $result->Title;

        $array['released'] = \Carbon\Carbon::parse($result->Released)->format('d F Y');
        // dd($array['released']);
        $array['runtime'] = $result->Runtime;
        $array['desc'] = $result->Plot;
        $array['imdbID'] = $result->imdbID;
        $array['poster'] = $result->Poster;
        $array['imdbRating'] = $result->imdbRating;
        $array['year'] = $result->Year;


        return response()->json($array, 200);
    }
}
