<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded = ['id'];
    protected $table = 'bcategory';

     public static function check($name)
   {
       if($obj = static::where('name',$name)->first()){
            return $obj->id;
       }else{
           return null;
       }
   }
}
