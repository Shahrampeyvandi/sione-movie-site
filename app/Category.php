<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    protected $guarded = ['id'];
    public $timestamps = false;

   public static function check($name)
   {
       if($obj = static::where('latin',$name)->first()){
            return $obj->id;
       }else{
           return null;
       }
   }
}
