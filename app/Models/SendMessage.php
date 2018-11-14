<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//发送消息Model
class SendMessage extends Model
{
   protected $casts=[];
   protected $fillable=['user_id','type','content'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
   }
}