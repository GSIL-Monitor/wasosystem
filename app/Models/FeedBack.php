<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//建议反馈Model
class FeedBack extends Model
{
    protected $table='feed_backs';
   protected $casts=['location'=>'array'];
   protected $fillable=['name','title','phone','email','content','show','location'];
   public function setLocationAttribute($value)
   {
       return $this->attributes['location']=json_encode($value,JSON_UNESCAPED_UNICODE);
   }
}