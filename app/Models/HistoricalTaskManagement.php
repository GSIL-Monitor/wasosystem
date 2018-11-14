<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//历史任务管理Model
class HistoricalTaskManagement extends Model
{
   protected $casts=[];
   public $timestamps=false;
   protected $fillable=['divisional_id','goal','guaranteed_task','returned_money','monthly_sales','outstanding','year','mouth','punish_award'];

}