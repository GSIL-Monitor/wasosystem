<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//企业管理Model
class BusinessManagement extends Model
{
   protected $casts=['pic'=>'array','field'=>'array'];
   protected $fillable=['type','top','sort','pic','field'];

    public function setPicAttribute($value)
    {
        return $this->attributes['pic']=json_encode($value,JSON_UNESCAPED_UNICODE);
   }
    public function getPicAttribute($value)
    {
        return  getImages($value);
    }

    public function setFieldAttribute($value)
    {
        return $this->attributes['field']=json_encode($value,JSON_UNESCAPED_UNICODE);
    }
}