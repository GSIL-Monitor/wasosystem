<?php

namespace App\Models;

use App\Comdodel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//订单管理Model
class Order extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $casts = ['pic' => 'array', 'participation_admin' => 'array'];
    protected $fillable = ['user_id', 'serial_number', 'machine_model', 'code', 'unit_price', 'total_prices', 'price_spread', 'num',
        'order_type', 'order_status', 'message_status', 'payment_status', 'service_status',
        'invoice_type', 'invoice_info', 'logistics_id', 'logistics_info', 'parcel_count', 'user_remark',
        'company_remark', 'urgent', 'flow_pic', 'in_common_use', 'pic', 'participation_admin', 'admin','market'];
    public function scopeBalanceOrder($query, $request)
    {
        $searchOrder = $request->get('keyword') ?? '';
        return $query->when($searchOrder, function ($query) use ($searchOrder) {
            return $query->where('serial_number', 'like', '%' .$searchOrder . '%');//筛选欠款订单
        })->latest();
    }
    public function scopeOrders($query, $request, $status)
    {
        $searchUser = $request->get('user_id') ?? false;
        $searchAdmin = $request->get('market') ?? false;
        $selfOrder = admin() ?? user();
        $searchOrder = ['type' => $request->get('type') ?? false,
            'keyword' => $request->get('keyword') ?? '',
        ];
        return $query
            ->with('user')
            ->when($selfOrder->can('show self_orders'), function ($query) use ($selfOrder) {
                return $query->whereMarket($selfOrder->account);//只能查看自己的订单
            })
            ->when($status != 'all_orders', function ($query) use ($status) {
                return $query->whereOrderStatus($status); //筛选订单类型
            })
            ->when($searchUser, function ($query) use ($searchUser) {
                return $query->whereUserId($searchUser);//筛选会员
            })
            ->when($searchAdmin, function ($query) use ($searchAdmin) {
                return $query->whereMarket($searchAdmin);//筛选管理员
            })
            ->Search($searchOrder)//查询
            ->latest();
    }

    public function scopeSearch($query, $searchOrder)
    {
        return $query
            ->when($searchOrder['type'], function ($query) use ($searchOrder) {
                $query->when($searchOrder['type'] == 'user_id', function ($query) use ($searchOrder) {
                    $username = User::where('username', 'like', '%' . $searchOrder['keyword'] . '%')->pluck('id');
                    return $query->whereIn('user_id', $username);//筛选管理员
                }, function ($query) use ($searchOrder) {
                    return $query->where($searchOrder['type'], 'like', '%' . $searchOrder['keyword'] . '%');//筛选管理员
                });
            });
    }

    public function setParticipationAdminAttribute($value)
    {
        return $this->attributes['participation_admin'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function setPicAttribute($value)
    {
        return $this->attributes['pic'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function getPicAttribute($value)
    {
        return getImages($value);
    }

    public function getRemarkAttribute()
    {
        $company_remark=$this->company_remark ? '订单备注：'.$this->company_remark.'，' :'';
        $user_remark=$this->user_remark ? '客户备注：'.$this->user_remark :'';
        return $company_remark.$user_remark;
    }

    public function warehouse_out()
    {
        return $this->hasOne(WarehouseOutManagement::class,'order_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->with('admins','user_address','user_company');
    }
    public function payment()
    {
        return $this->belongsTo(MemberStatus::class, 'payment_status', 'identifying');
    }

    public function service()
    {
        return $this->belongsTo(MemberStatus::class, 'service_status', 'identifying');
    }

    public function markets()
    {
        return $this->belongsTo(Admin::class, 'market', 'account');
    }
    public function company()
    {
        return $this->belongsTo(UserCompany::class, 'invoice_info', 'id');
    }
    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'logistics_id', 'id');
    }

    public function orderMaterial()
    {
        return $this->hasMany(OrderMaterial::class);
    }
    //出库信息
    public function warehouseOut()
    {
        return $this->hasOne(WarehouseOutManagement::class,'order_id','id')->with('codes');
    }
    /*----------------获取订单里的物料配件-------------------------*/
    public function order_product_goods()
    {
        return $this->belongsToMany(ProductGood::Class, 'order_materials', 'order_id', 'product_good_id')->withPivot('product_good_num','product_number','product_good_price','product_good_raid')->with(['product','framework','product_goods_self_build_terrace.product'])->oldest('product_number');
    }
    public function order_demand_management()
    {
        return $this->belongsToMany(DemandManagement::class, 'demand_management_orders', 'order_id', 'demand_management_id');
    }
}