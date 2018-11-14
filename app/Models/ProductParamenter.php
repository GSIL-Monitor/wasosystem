<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductParamenter
 *
 * @package App\Models
 * @property int $id
 * @property string $name 参数名
 * @property string|null $danwei 单位
 * @property string $type 显示类型
 * @property string $show_type 指定参数
 * @property int $qiantai_show 前台是否显示
 * @property int $admin_show
 * @property int|null $order 排序
 * @property int $product_id 专有项的产品id
 * @property int $parent_id 专有项子参数的父级id
 * @property int $parameter_pid 指定的父级参数
 * @property int $parameter_id 指定的参数
 * @property int $oid 指定的参数
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductParamenter[] $Childrens
 * @property-read \App\Models\ProductFramework $frameWorks_series
 * @property-read \App\Models\ProductGood $goods
 * @property-read \App\Models\ProductParamenter $paramenter
 * @property-read \App\Models\ProductParamenter $paramenters
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter order()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereAdminShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereDanwei($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereOid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereParameterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereParameterPid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereQiantaiShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereShowType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductParamenter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductParamenter extends Model
{
    protected $fillable=['name','danwei','order','qiantai_show','admin_show','type','show_type','product_id','parent_id','parameter_pid','parameter_id'];


    public function scopeOrder($query){
        return $query->orderBy('order','asc');
    }

    public  function Childrens(){
        return $this->hasMany('App\Models\ProductParamenter','parent_id','id');
    }

    public  function frameWorks_series(){
        return $this->belongsTo('App\Models\ProductFramework','parameter_id','product_id');
    }

    public  function goods(){
        return $this->belongsTo('App\Models\ProductGood','parameter_id','product_id');
    }
    public  function paramenters(){
        return $this->belongsTo('App\Models\ProductParamenter','parameter_id','parent_id');
    }
    public  function paramenter(){
        return $this->belongsTo('App\Models\ProductParamenter','parameter_pid','product_id');
    }
}
