<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//部门管理Model
class DivisionalManagement extends Model
{

   protected $casts=[];
   protected $fillable=['name','identifying','admin_id','parent_id'];


    public function admins()
    {
        return $this->hasOne(Admin::class,'id','admin_id');
    }
}