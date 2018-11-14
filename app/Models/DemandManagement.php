<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//需求管理Model
class DemandManagement extends Model
{
    protected $casts = ['assistant'=>'array','collocate'=>'array','send'=>'boolean'];
    protected $fillable = ['user_id','visitor_details_id','demand_number','collocate','explain',
        'budget','demand_status','customer_status','the_next_step_program','admin','record','assistant','send','analog_data'
        ];


    public function scopeDemand($query, $request, $status)
    {
        $selfOrder = auth('admin')->user();
        $select_date=$request->get('select_date') ?? '';
        $searchOrder = ['type' => $request->get('type') ?? false,
            'keyword' => $request->get('keyword') ?? '',
        ];
        return $query
            ->with('user','demand_management_order','demand_management_filtrate','visitor_detail')
            ->when($selfOrder->can('show self_demand_managements'), function ($query) use ($selfOrder) {
                return $query->whereAdmin($selfOrder->account);//只能查看自己的需求
            })
            ->when($status != 'all_demand' , function ($query) use ($status) {
                if($status=='analog_input'){
                    return $query->whereAnalogData(true); //筛选模拟录入
                }elseif ($status=='helper'){
                    return $query->where('assistant','<>','[]'); //筛选协同

                }else{
                    return $query->whereDemandStatus($status); //筛选需求类型
                }
            })
            ->when($select_date, function ($query) use ($select_date) {
                 $date=explode(' - ',$select_date);
                return $query->whereDate('created_at','>=', $date[0])->whereDate('created_at','<=', $date[1]);//时间筛选
            })
            ->Search($searchOrder)//查询
            ->latest();
    }
    public function scopeSearch($query, $searchOrder)
    {
        return $query
            ->when($searchOrder['type'], function ($query) use ($searchOrder) {
                $query->when($searchOrder['type'] == 'user_id' || $searchOrder['type'] == 'admin' , function ($query) use ($searchOrder) {
                    if($searchOrder['type']=='admin'){
                        $account = Admin::where('account', 'like', '%' . $searchOrder['keyword'] . '%')->pluck('id');
                        return $query->whereIn('admin', $account);//筛选会员
                    }else{
                        $username = User::where('username', 'like', '%' . $searchOrder['keyword'] . '%')->pluck('id');
                        return $query->whereIn('user_id', $username);//筛选管理员
                    }
                }, function ($query) use ($searchOrder) {
                    return $query->where($searchOrder['type'], 'like', '%' . $searchOrder['keyword'] . '%');
                });
            });
    }
    public function demand_management_filtrate()
    {
        return $this->belongsToMany(DemandFiltrate::class, 'demand_management_filtrates', 'demand_management_id', 'demand_filtrates_id');
    }
    public function visitor_detail()
    {
        return $this->belongsTo(VisitorDetail::class, 'visitor_details_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function administrator()
    {
        return $this->belongsTo(Admin::class, 'admin', 'id');
    }
    public function demand_management_order()
    {
        return $this->belongsToMany(Order::class, 'demand_management_orders', 'demand_management_id', 'order_id');
    }

    public function setCollocateAttribute($value)
    {
        return $this->attributes['collocate'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function setAssistantAttribute($value)
    {
        return $this->attributes['assistant'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}