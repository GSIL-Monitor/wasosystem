<?php

namespace App\Models;

use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//会员管理Model
class User extends Authenticatable
{
    use Notifiable;
    protected $casts = ['avatar' => 'array', 'parameters' => 'array'];
    protected $dates=['last_login_time'];
    protected $fillable = [
        'username', 'password', 'clear_text', 'nickname', 'sex', 'birthday', 'phone', 'email', 'telephone',
        'wechat', 'qq', 'unit', 'industry', 'address', 'grade', 'administrator', 'payment_days',
        'tax_rate', 'message_type', 'parts_buy', 'register_ip', 'last_login_ip', 'login_count',
        'last_login_time', 'deal', 'avatar', 'parameters',
    ];

    public function notification()
    {
        return $this->belongsToMany(Notification::class,'user_notifications')->withPivot('state')->latest('notification_id');
    }

    public function newUser()
    {
        return $this->created_at == $this->updated_at ;
    }
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
   //查找欠款会员
    public function scopeDebitUser($query,$user_id,$request)
    {
        $searchUser =$request->get('keyword') ?? '';
        return $query
            ->with('admins', 'grades','user_company','orders')
            ->where([
                ['grade', '<>', 'unverified'],
                ['grade', '<>', 'blocked_account'],
            ])
            ->whereIn('id',$user_id)
            ->when($searchUser, function ($query) use ($searchUser) {
                return $query->where('username','like','%'.$searchUser.'%'); //如果有提交查询
            })
            ->latest('last_login_time');
    }
    //查找认证会员
    public function scopeVerifiedUser($query,$request)
    {
        $selfUser = auth('admin')->user();
        $searchUser =['type'=>$request->get('type') ?? false,
                     'keyword'=>$request->get('keyword') ?? '',
                    ];
        return $query
            ->with('admins', 'grades','user_company')
            ->where([
                ['grade', '<>', 'unverified'],
                ['grade', '<>', 'blocked_account'],
            ])
            ->when($selfUser->can('show self_user'), function ($query) use ($selfUser) {
                return $query->where('administrator', $selfUser->id); //如果有查看自己会员的权限
            })
            ->when($searchUser['type'], function ($query) use ($searchUser) {
                return $query->where($searchUser['type'],'like','%'.$searchUser['keyword'].'%'); //如果有提交查询
            })
            ->latest('last_login_time');
    }
    //联系方式访问器
    public function getContactAttribute()
    {
        return "{$this->phone}  {$this->email}  {$this->wechat}   {$this->qq}";
    }
    //查找未认证会员
    public function scopeUnverified($query)
    {
        return $query->with('admins', 'grades','user_company')->whereGrade("Unverified")->latest();
    }

    //查找冻结账户
    public function scopeBlockedAccount($query)
    {
        $selfUser = auth('admin')->user();
        return $query->with('admins', 'grades','user_company')->whereGrade('blocked_account')
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
    public function visitor_details()
    {
        return $this->hasOne(VisitorDetail::class);
    }
    //grade
    public function tax_rates()
    {
        return $this->belongsTo(MemberStatus::class, 'tax_rate', 'id');
    }

    public function user_address()
    {
        return $this->hasMany('App\Models\UserAddress');
    }
    public function user_company()
    {
        return $this->hasMany('App\Models\UserCompany');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function common_equipment()
    {
        return $this->hasMany('App\Models\CommonEquipment');
    }
    public function funds()
    {
        return $this->hasMany(FundsManagement::class,'user_id','id');
    }
    public function user_product()
    {
        return $this->belongsToMany(ProductGood::class,'user_products')->withPivot('id','product_good_num','product_number','product_good_price','product_good_raid')
            ->with('framework','product');

    }
    public function favoriteCompleteMachines()
    {
        return $this->belongsToMany(CompleteMachine::class, 'user_favorite_complete_machines')
            ->withTimestamps()
            ->orderBy('user_favorite_complete_machines.created_at', 'desc');
    }
}