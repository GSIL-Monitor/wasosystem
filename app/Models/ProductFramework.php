<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductFramework
 *
 * @property int $id
 * @property string $name 架构系列名
 * @property int $product_id 产品id
 * @property int $parent_id 父级id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductFramework[] $Childrens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFramework condition($product_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFramework order()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFramework whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFramework whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFramework whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFramework whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFramework whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFramework whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductFramework extends Model
{
    protected $fillable=['name','product_id','parent_id',];

    public function scopeCondition($query,$product_id){
        return $query->where([
            ['product_id', '=', $product_id],
            ['parent_id', '=', 0],
        ]);
    }
    public function scopeOrder($query){
        return $query->orderBy('name','asc');
    }
    public  function Childrens(){
        return $this->hasMany('App\Models\ProductFramework','parent_id','id');
    }
    public  function drive(){
        return $this->hasMany(ProductDrive::class,'product_frame_works_id','id');
    }
}
