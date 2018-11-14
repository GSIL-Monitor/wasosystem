<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//资讯管理Model
class InformationManagement extends Model
{
   protected $casts=['pic'=>'array','marketing'=>'array'];
   protected $fillable=['type','name','description','content','pic','marketing','read_count'];

    public function getSearchTypeAttribute()
    {
        return 'informationManagement';
    }
    public function setPicAttribute($value)
    {
        return $this->attributes['pic']=json_encode($value,JSON_UNESCAPED_UNICODE);
   }
    public function setMarketingAttribute($value)
    {
        return $this->attributes['marketing']=json_encode($value,JSON_UNESCAPED_UNICODE);
    }
    public function getPicAttribute($value)
    {
        return getImages($value);
    }
    public function visits()
    {
        return visits($this);
    }
    /*----------------绑定整机-------------------------*/
    public function information_management_complete_machines()
    {
        return $this->belongsToMany(CompleteMachine::Class, 'information_complete_machines');
    }

}