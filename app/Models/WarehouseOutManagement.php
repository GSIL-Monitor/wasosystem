<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
//出库管理Model
class WarehouseOutManagement extends Model
{
   protected $casts=['created_at'=>'datetime:Y-m-d'];
   protected $fillable=['user_id','order_id','out_type','out_status','associated_disposal','serial_number','out_number','finish_out_number','admin','postscript'];

    public function getTypeAttribute()
    {
        return 'WarehouseOutManagement';
    }
    public function scopeCondition($query,$status,$request)
    {
        $searchOrder = ['type' => $request->get('type') ?? false,
            'keyword' => $request->get('keyword') ?? '',
        ];
        return $query
            ->with(['user','admins','order','order.markets'])
            ->where(function ($query) use ($status){
                if($status == 'inventory_machine' ){
                    $query->whereUserId(994)->whereOutStatus('unfinished'); //库存整机专用Id
                }else{
                    $query->whereOutStatus($status)->where('user_id','<>',994);
                }
            })
            ->Search($searchOrder)//查询
            ;
    }
    public function scopeSearch($query, $searchOrder)
    {
        return $query
            ->when($searchOrder['type'], function ($query) use ($searchOrder) {
                $query->when($searchOrder['type'] == 'user_id', function ($query) use ($searchOrder) {
                    return $query->whereHas('user', function ($query) use ($searchOrder) {
                        $query->where(function ($query) use ($searchOrder) {
                            $query->orWhere('username', 'like', '%' . $searchOrder['keyword'] . '%')
                                  ->orWhere('nickname', 'like', '%' . $searchOrder['keyword'] . '%');
                        });
                    });
                }, function ($query) use ($searchOrder) {
                    return $query->when($searchOrder['type'] == 'code', function ($query) use ($searchOrder) {
                        return $query->whereHas('codes', function ($query) use ($searchOrder) {
                            $query->where('code', 'like', '%' . $searchOrder['keyword'] . '%');
                        });
                    }, function ($query) use ($searchOrder) {
                        return $query->when($searchOrder['type'] == 'product', function ($query) use ($searchOrder) {
                            return $query->whereHas('codes.product_good', function ($query) use ($searchOrder) {
                                $query->where('name', 'like', '%' . $searchOrder['keyword'] . '%');
                            });
                        }, function ($query) use ($searchOrder) {
                            return $query->where($searchOrder['type'], 'like', '%' . $searchOrder['keyword'] . '%');//筛选管理员
                        });
                    });
                });
            });

    }
   public function codes(){
        return $this->hasMany(Code::class,'warehouse_out_management_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function admins()
    {
        return $this->belongsTo(Admin::class,'admin','id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
}