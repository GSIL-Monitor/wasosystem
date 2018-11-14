<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//销售任务管理Model
class TaskManagement extends Model
{
   protected $casts=[];
   protected $fillable=['divisional_id','task_mode','goal','guaranteed_task','award_coefficient','goal_two',
                        'guaranteed_task_two','award_coefficient_two','goal_three','guaranteed_task_three',
       'award_coefficient_three','punish_index','award_index','units_index'];
    public function divisional()
    {
        return $this->belongsTo(DivisionalManagement::class,'divisional_id','id');
    }
}