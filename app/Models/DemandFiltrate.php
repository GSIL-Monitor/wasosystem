<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
//需求管理筛选Model
class DemandFiltrate extends Model
{
    use NodeTrait;
   protected $casts=[];
   protected $fillable=['name','parent_id','category'];
    public function filtrate_demand_management()
    {
        return $this->belongsToMany(DemandManagement::class, 'demand_management_filtrates', 'demand_filtrates_id', 'demand_management_id');
    }
}