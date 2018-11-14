<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//会员公告管理Model
class Notification extends Model
{
    protected $casts=['to_user'=>'array'];
   protected $fillable=['to_user','content','title','type'];
    public function setToUserAttribute($value)
    {
        return $this->attributes['to_user']=json_encode($value,JSON_UNESCAPED_UNICODE);
    }

}