<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//旧网站订单管理Model
class OldOrder extends Model
{
   protected $casts=[];
   protected $fillable=[];
   public function good(){
       return $this->hasMany(OldGood::class,'pay_id','proid');
   }
    public function yingpan(){
        return $this->hasMany(OldYingpan::class,'userid','id');
    }
    //查找认证会员
    public function scopeOldorder($query,$request)
    {
        $searchUser =['type'=>$request->get('type') ?? false,
            'keyword'=>$request->get('keyword') ?? '',
        ];
        return $query
            ->when($request->type, function ($query) use ($request) {
                return $query->where($request->type,'like',"%{$request->keyword}%"); //如果有提交查询
            })
            ->latest('prodate');
    }

}