<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
//部门管理Model
class DivisionalManagement extends Model
{
    use NodeTrait;
   protected $casts=[];
   protected $fillable=['name','identifying','admin_id','parent_id'];

    public function task()
    {
        return $this->hasOne(TaskManagement::class,'divisional_id','id');
    }
    public function historical_task()
    {
        return $this->hasOne(HistoricalTaskManagement::class,'divisional_id','id');
    }
    public function admins()
    {
        return $this->hasOne(Admin::class,'id','admin_id');
    }
}