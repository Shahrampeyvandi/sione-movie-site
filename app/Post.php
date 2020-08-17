<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];
    protected $with = ['categories', 'languages', 'actors', 'directors'];
    protected $casts = [
        'awards' => 'array',
    ];


    public function checkDubleFarsi()
    {
        $count = $this->whereHas('categories', function ($q) {
            $q->where('name', 'دوبله فارسی');
        })->count();
        if ($count) {
            return true;
        } else {
            return false;
        }
    }

    public function relatedPosts()
    {
        $categories = $this->categories;
        $pluck = $categories->pluck('id');
        return  static::whereHas('categories', function ($q) use ($pluck) {
            $q->whereIn('id', $pluck);
        })->where('id', '!=', $this->id)->where(['type'=>$this->type,'comming_soon'=>0])->take(6)->get();
    }



    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
   public function captions()
    {
        return $this->morphMany(Caption::class, 'captionable');
    }
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
    public function awards()
    {
        return $this->hasMany(Award::class);
    }
    public function videos()
    {
        return $this->morphMany(Video::class, 'videoble');
    }
    // image and comment may be for videos or blogs

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // votes may be for videos or comments
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'post_actor', 'post_id', 'actor_id');
    }

    public function writers()
    {
        return $this->belongsToMany(Writer::class, 'post_writer', 'post_id', 'writer_id');
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class, 'post_director', 'post_id', 'director_id');
    }
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'post_language', 'post_id', 'language_id');
    }
    public function trailer()
    {
        return $this->hasOne(Trailer::class);
    }

    public function path()
    {
        if ($this->type == 'movies') {
            return route('ShowMovie', $this->slug);
        }
        if ($this->type == 'series') {
            $season = $this->seasons->first();

            if ($season) {
                $id = $season->number;
            } else {
                $id = 1;
            }
            return route('ShowSerie', ['slug' => $this->slug, 'season' => $id]);
        }
    }
    public function play()
    {
        if($this->comming_soon == '1') {
            if($this->trailer) {
                return route('S.Trailer', ['slug' => $this->slug]);
            }else{
                return '#';
            }
        }
        if ($this->type == 'movies') {
            return route('S.Play', ['slug' => $this->slug]);
        }
        return '#';

       
    }

      public function downloadpath()
    {

        if ($this->type == 'movies') {
            return route('DownLoad', ['id' => $this->id]);
        }
    }

      public function favoritepath()
    {

       return route('S.addToFavorite');
    }

    
    public function checkFavorite()
    {
        
        if(auth()->check()){
            $user = auth()->user();
        }
        if(auth()->guard('admin')->check()){
            $user = auth()->guard('admin')->user();
        }
        if($user->favorite->contains('id',$this->id)) {
            return true;
        }else{
            return false;
        }

    }



    public static function withCategory($name)
    {
        $posts = Post::whereHas('categories', function ($q) use ($name) {
            $q->where('latin', $name);
        })->latest()->get();
    }
}
