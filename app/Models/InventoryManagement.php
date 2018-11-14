<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//库存管理Model
class InventoryManagement extends Model
{
   protected $casts=[];
   protected $fillable=['product_id','product_good_id','new','good','bad','return_factory','proxies','test','warning'];

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
   }

    public function product_good()
    {
        return $this->hasOne(ProductGood::class,'id','product_good_id');
   }

    public function scopeCondition($query,$product_id,$request)
    {
        $searchOrder = [
            'keyword' => $request->get('keyword') ?? '',
        ];
        return $query->whereProductId($product_id)
            ->where(function ($query){
                $query->orWhere('new','>',0)
                    ->orWhere('good','>',0)
                    ->orWhere('bad','>',0)
                    ->orWhere('return_factory','>',0)
                    ->orWhere('proxies','>',0)
                    ->orWhere('test','>',0);
            })
            ->when($searchOrder['keyword'], function ($query) use ($searchOrder) {
            return $query->whereHas('product_good', function ($query) use ($searchOrder) {
                $query->where('name', 'like', '%' . $searchOrder['keyword'] . '%');
            });
    });
   }
}