<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//会员公告管理Model
class UserNotification extends Model
{
   protected $fillable=['user_id','state','notification_id'];

}