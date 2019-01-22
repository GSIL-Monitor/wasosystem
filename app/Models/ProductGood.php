<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\ProductGood
 *
 * @property int $id
 * @property int $product_id 产品id
 * @property int $jiagou_id 产品架构id
 * @property int $xilie_id 产品系列id
 * @property string $name 产品名称
 * @property string|null $jiancheng 产品简称
 * @property string|null $jianma 产品简码
 * @property string|null $daima 产品原厂代码
 * @property array $price 产品级别价格
 * @property string $float 价格浮动
 * @property array $status 产品状态
 * @property int|null $quality_time 产品质保时间
 * @property mixed|null $pic 产品原图
 * @property array $details 产品的详细参数  这里我用json 保存
 * @property int|null $oldid 旧数据产品id 做数据迁移的时候使用
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\Models\ProductFramework $framework
 * @property-read \App\Models\ProductGood $goodPrice
 * @property-read \App\Models\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin[] $product_goods_admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CompleteMachine[] $product_goods_complete_machine
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductGood[] $product_goods_self_build_terrace
 * @property-read \App\Models\ProductFramework $series
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood condition($product_id)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductGood onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereDaima($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereFloat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereJiagouId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereJiancheng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereJianma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood wherePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereQualityTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGood whereXilieId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductGood withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductGood withoutTrashed()
 * @mixin \Eloquent
 */
class ProductGood extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $casts=['price'=>'array','pic'=>'array','status'=>'array','details'=>'array'];
    protected $fillable=['product_id','jiagou_id','xilie_id','name','jiancheng','jianma'
        ,'daima','price','status','quality_time','pic','details','float','series_name','framework_name'
    ];
    public function scopeSearchJson($query, $search,$column)
    {
        return $query
            ->where(function ($query) use ($search,$column) {
                foreach ($search as $item){
                    $query ->orWhere(function ($query) use ($item,$column) {
                        $query->whereJsonContains($column, $item);
                    });
                }
            });
    }
    public function scopeCondition($query,$product_id){
        return $query->where([
            ['product_id', '=', $product_id],
        ]);
    }
    public function setPriceAttribute($value){
        return $this->attributes['price']=json_encode($value,JSON_UNESCAPED_UNICODE) ?? '';
    }
    public function setStatusAttribute($value){
        return $this->attributes['status']=json_encode($value,JSON_UNESCAPED_UNICODE) ?? '';
    }
    public function setPicAttribute($value){
        return $this->attributes['pic']=json_encode($value,JSON_UNESCAPED_UNICODE) ?? '';
    }
    public function getPicsAttribute($value){
        return getImages($value);
    }
    public function setDetailsAttribute($value){
        return $this->attributes['details']=json_encode($value,JSON_UNESCAPED_UNICODE) ?? '';
    }

    public function getQualityTime($orderTime)
    {
        $qualityTime=$this->quality_time;
        $orderTimeYear=$orderTime->format('Y');
        $totalTime=$qualityTime + $orderTimeYear;
        $orderTimeMouth=$orderTime->format('m');
        $orderTimeDay=$orderTime->format('d');
        $expirationTime=strtotime($totalTime.'-'.$orderTimeMouth.'-'.$orderTimeDay);
        $remainingTime=round((($expirationTime - time()) / 86400));
        return $remainingTime > 0 ? $remainingTime : '已过质保' ;
    }
    public  function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
    public  function goodPrice(){
        return $this->belongsTo('App\Models\ProductGood','product_id','id');
    }
    public  function framework(){
        return $this->belongsTo('App\Models\ProductFramework','jiagou_id','id');
    }

    public  function series(){
        return $this->belongsTo('App\Models\ProductFramework','xilie_id','id');
    }
    public function product_goods_complete_machine()
    {
        return $this->belongsToMany(CompleteMachine::Class,'complete_machine_product_goods', 'product_good_id', 'complete_machine_id');
    }
    public function product_goods_self_build_terrace()
    {
        return $this->belongsToMany(ProductGood::Class,'self_build_terraces', 'self_build_terrace_id', 'product_good_id')->withPivot('product_good_num','product_number')->with('product');
    }
    public function product_goods_admin()
    {
        return $this->belongsToMany(Admin::Class,'temporary_product_goods', 'product_good_id', 'admin_id');
    }
    public function product_goods_order()
    {
        return $this->belongsToMany(Order::Class,'order_materials', 'product_good_id', 'order_id')
            ->withPivot('product_good_num','product_number','product_good_price','product_good_raid');
    }
    public function product_goods_common_equipment()
    {
        return $this->belongsToMany(CommonEquipment::Class,'common_equipment_materials', 'product_good_id', 'common_equipment_id');
    }
    public function inventory_management()
    {
        return $this->hasOne(InventoryManagement::class);
    }
    public function getPicAttribute($value){
        return getImages($value);
    }
    public  function drive(){
        return $this->hasMany(ProductDrive::class,'product_good_id','id');
    }
}
