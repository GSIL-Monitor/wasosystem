<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDrive extends Model
{
    protected $casts=['file'=>'array'];
    protected $fillable=['product_frame_works_id','product_good_id','file'
    ];
    public function setPicAttribute($value){
        return $this->attributes['file']=json_encode($value,JSON_UNESCAPED_UNICODE) ?? '';
    }
    public function getPicsAttribute($value){
        return getImages($value);
    }
    public function file(){
        return json_decode($this->file,true);
    }
}
