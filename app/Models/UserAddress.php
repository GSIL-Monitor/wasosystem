<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//会员物流地址管理Model
class UserAddress extends Model
{
    protected $casts = [];
    protected $fillable = [
        "user_id",
        "address",
        "name",
        "phone",
        "alternative_phone",
        "logistics",
        "default",
        "number",
        "zip"
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}