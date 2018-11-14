<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//会员状态管理Model
class MemberStatus extends Model
{
    protected $casts=[];
    protected $fillable=['identifying','name','parent_id','type'];
}