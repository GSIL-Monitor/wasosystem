<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//微信应用管理Model
class WeChatApplicationManagement extends Model
{
   protected $casts=['group_chat_array'=>'array'];
   protected $fillable=['agentId','name','secret','group_chat_array','identifying','description'];
    public function setGroupChatArrayAttribute($value){
        return $this->attributes['group_chat_array']=json_encode($value,JSON_UNESCAPED_UNICODE) ?? '';
    }
}