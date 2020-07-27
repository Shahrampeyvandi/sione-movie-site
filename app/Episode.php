<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $guarded = ['id'];


     public function videos()
    {
        return $this->morphMany(Video::class, 'videoble');
    }

     public function seasonobj()
    {
        return $this->belongsTo(Season::class,'season');
    }

     public function serie()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
}
