<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SelfBuildTerrace
 *
 * @property int $product_good_id
 * @property int $self_build_terrace_id
 * @property int $product_good_num 数量
 * @property string $product_number 排序
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductGood[] $self_build_terrace_product_goods
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfBuildTerrace whereProductGoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfBuildTerrace whereProductGoodNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfBuildTerrace whereProductNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfBuildTerrace whereSelfBuildTerraceId($value)
 * @mixin \Eloquent
 */
class SelfBuildTerrace extends Model
{
   protected $fillable=[];
    public function self_build_terrace_product_goods()
    {
        return $this->belongsToMany(ProductGood::Class, 'self_build_terrace_product_goods', 'self_build_terrace_id', 'product_good_id')->withPivot('product_good_num','product_number')->with(['product','product_goods_admin']);
    }

}