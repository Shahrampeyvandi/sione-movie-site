<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = ['id'];
    protected $table = 'blogs';

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_bcategory', 'blog_id', 'category_id');
    }

    public function links()
    {
        return $this->hasMany(BlogLink::class);
    }
}
