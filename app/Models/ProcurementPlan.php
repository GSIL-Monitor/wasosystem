<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//采购计划Model
class ProcurementPlan extends Model
{
   protected $casts=['code'=>'array','two_code'=>'array'];
   protected $fillable=['supplier_managements_id','product_good_id','product_id','procurement_type','procurement',
       'product_colour','procurement_status','serial_number','procurement_number','finish_procurement_number',
       'quality_time','postscript','logistics_company','logistics_number','admin','purchase','code','two_code'];

    public function setCodeAttribute($value){
        return $this->attributes['code']=json_encode($value,JSON_UNESCAPED_UNICODE);
    }
    public function setTwoCodeAttribute($value){
        return $this->attributes['two_code']=json_encode($value,JSON_UNESCAPED_UNICODE);
    }

    public function scopeCondition($query,$status,$request)
    {
        $searchOrder = ['type' => $request->get('type') ?? false,
            'keyword' => $request->get('keyword') ?? '',
        ];
        return $query
            ->with(['supplier_managements','products','product_goods','purchases'])
            ->whereProcurementStatus($status)
            ->Search($searchOrder)//查询
            ->latest();
    }
    public function scopeSearch($query, $searchOrder)
    {
        return $query
            ->when($searchOrder['type'], function ($query) use ($searchOrder) {
                $query->when($searchOrder['type'] == 'supplier_managements_id', function ($query) use ($searchOrder) {
                    return $query->whereHas('supplier_managements', function ($query) use ($searchOrder) {
                        $query->where(function ($query) use ($searchOrder) {
                            $query->orWhere('name', 'like', '%' . $searchOrder['keyword'] . '%')
                                ->orWhere('code', 'like', '%' . $searchOrder['keyword'] . '%');
                        });
                    });
                }, function ($query) use ($searchOrder) {
                    return $query->when($searchOrder['type'] == 'product_good_id', function ($query) use ($searchOrder) {
                        return $query->whereHas('product_goods', function ($query) use ($searchOrder) {
                            $query->where(function ($query) use ($searchOrder) {
                                $query->orWhere('name', 'like', '%' . $searchOrder['keyword'] . '%')
                                    ->orWhere('jiancheng', 'like', '%' . $searchOrder['keyword'] . '%');
                            });
                        });
                    }, function ($query) use ($searchOrder) {
                        return $query->where($searchOrder['type'], 'like', '%' . $searchOrder['keyword'] . '%');//筛选管理员
                    });
                });
            });
    }

    public function supplier_managements()
    {
        return $this->belongsTo(SupplierManagement::class,'supplier_managements_id','id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function product_goods()
    {
        return $this->belongsTo(ProductGood::class,'product_good_id','id');
    }
    public function admins()
    {
        return $this->belongsTo(Admin::class,'admin','id');
    }
    public function purchases()
    {
        return $this->belongsTo(Admin::class,'purchase','id');
    }
    public function inventory()
    {
        return $this->belongsTo(InventoryManagement::class,'product_good_id','product_good_id');
    }
}