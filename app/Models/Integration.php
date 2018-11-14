<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//软硬一体化Model
class Integration extends Model
{

   protected $fillable=['parent_id','name','pic','description','show','details','click'];

    public function getSearchTypeAttribute()
    {
        return 'integration';
    }
    public function setPicAttribute($value)
    {
        return $this->attributes['pic']=json_encode($value,JSON_UNESCAPED_UNICODE) ?? '';
    }
    public function getPicAttribute($value)
    {
        return getImages($value);
    }
    public function parent()
    {
        return $this->belongsTo(IntegrationCategory::class,'parent_id','id');
    }
    /*----------------绑定整机-------------------------*/
    public function Integration_complete_machines()
    {
        return $this->belongsToMany(CompleteMachine::Class, 'integration_complete_machines', 'integration_id', 'complete_machine_id');
    }

}