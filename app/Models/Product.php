<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $title 产品名
 * @property string|null $jianma 产品简码
 * @property string $bianhao 产品排序
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereBianhao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereJianma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product_canshu[] $ChildrenChanshus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Framework[] $jiagou
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductParamenter[] $Childrens
 * @property-read \App\Models\ProductFramework $frameWorks_series
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductFramework[] $framework
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductGood[] $good
 * @property-read \App\Models\ProductGood $goods
 * @property-read \App\Models\ProductParamenter $paramenter
 * @property-read \App\Models\ProductParamenter $paramenters
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product order()
 */
class Product extends Model
{
    protected $fillable=['title','jianma','bianhao'];


    public function scopeOrder($query)
    {
        return $query->orderBy('bianhao','asc');
    }
    public function framework()
    {
        return $this->hasMany('App\Models\ProductFramework','product_id','id');
    }
    public function good()
    {
        return $this->hasMany('App\Models\ProductGood','product_id','id');
    }
    public  function Childrens(){
        return $this->hasMany('App\Models\ProductParamenter','product_id','id');
    }

    public  function frameWorks_series(){
        return $this->belongsTo('App\Models\ProductFramework','parameter_id','product_id');
    }

    public  function goods(){
        return $this->belongsTo('App\Models\ProductGood','parameter_id','product_id');
    }
    public  function paramenters(){
        return $this->belongsTo('App\Models\ProductParamenter','parameter_id','parent_id')->with('paramenters');
    }
    public  function paramenter(){
        return $this->belongsTo('App\Models\ProductParamenter','parameter_pid','product_id')->with('paramenter');
    }
}
