<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//软硬一体化分类Model
class IntegrationCategory extends Model
{
    protected $casts=['pic'=>'array'];
   protected $fillable=['name','pic'];

    public function child()
    {
        return $this->hasMany(Integration::class,'parent_id','id');
   }
    public function setPicAttribute($value)
    {
        return $this->attributes['pic']=json_encode($value,JSON_UNESCAPED_UNICODE) ?? '';
   }
    public function getPicAttribute($value)
    {
        return getImages($value);
    }
}