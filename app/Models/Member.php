<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//会员管理Model
class Member extends Model
{
    protected $casts = ['avatar' => 'array', 'parameters' => 'array'];
    protected $fillable = [
        'username', 'password', 'clear_text', 'nickname', 'sex', 'birthday', 'phone', 'email', 'telephone',
        'wechat', 'qq', 'unit', 'industry', 'address', 'grade', 'administrator', 'payment_days',
        'tax_rate', 'message_type', 'parts_buy', 'register_ip', 'last_login_ip', 'login_count',
        'last_login_time', 'deal', 'avatar', 'parameters',
    ];

    public function setAvatarAttribute($value)
    {
        return $this->attributes['avatar'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getAvatarAttribute($value)
    {
        return getImages($value);
    }

    public function setParametersAttribute($value)
    {
        return $this->attributes['parameters'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    //查找认证会员
    public function scopeVerifiedMember($query)
    {
        $selfUser = auth('admin')->user();
        return $query
            ->with('admins', 'grades')
            ->where([
                ['grade', '<>', 'unverified'],
                ['grade', '<>', 'blocked_account'],
            ])
            ->when($selfUser->can('show self_user'), function ($query) use ($selfUser) {
                return $query->where('administrator', $selfUser->id); //如果有查看自己会员的权限
            })
            ->latest('last_login_time');
    }

    //查找未认证会员
    public function scopeUnverified($query)
    {
        return $query->with('admins', 'grades')->whereGrade("Unverified")->latest();
    }

    //查找冻结账户
    public function scopeBlockedAccount($query)
    {
        $selfUser = auth('admin')->user();
        return $query->whereGrade('blocked_account')
            ->when($selfUser->can('show self_user'), function ($query) use ($selfUser) {
                return $query->where('administrator', $selfUser->id); //如果有查看自己会员的权限
            })
            ->latest();
    }

    //admin
    public function admins()
    {
        return $this->belongsTo(Admin::class, 'administrator', 'id');
    }

    //grade
    public function grades()
    {
        return $this->belongsTo(MemberStatus::class, 'grade', 'identifying');
    }
    //grade
    public function tax_rates()
    {
        return $this->belongsTo(MemberStatus::class, 'tax_rate', 'id');
    }

}