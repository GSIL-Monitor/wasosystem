<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//客情管理Model
class VisitorDetail extends Model
{
    protected $casts = [];
    protected $fillable = [
        "user_id",
        "source",
        "nickname",
        "industry",
        "address",
        "search",
        "key",
        "phone",
        "email",
        "wechat",
        "qq",
        "admin",
        "details",
        "cantact_count",
        "valid"
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function admin_name(){
        return $this->belongsTo(Admin::class,'admin','account');
    }
    //需求
    public function scopeVaildVisitorDetails($query,$request,$valid)
    {
        $self_visitor_details = auth('admin')->user();
        $searchVisitor_details =[
            'type'=>$request->get('type') ?? false,
            'keyword'=>$request->get('keyword') ?? '',
        ];
        return $query
            ->with('user','admin_name')
            ->whereValid($valid)
            ->when($self_visitor_details->can('show self_visitor_details') && $valid =='yes', function ($query) use ($self_visitor_details) {
                if($self_visitor_details->can('show visitor_details')){
                }else{
                    return $query->where('admin', $self_visitor_details->id); //如果有查看自己会员的权限
                }
            })
            ->when($searchVisitor_details['type'], function ($query) use ($searchVisitor_details) {
                return $query->where($searchVisitor_details['type'],'like','%'.$searchVisitor_details['keyword'].'%'); //如果有提交查询
            })
            ->latest();
    }
    //联系方式访问器
    public function getContactAttribute()
    {
        return "{$this->phone}  {$this->email}  {$this->wechat}   {$this->qq}";
    }
}