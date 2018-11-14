<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
/**
 * App\Models\CompleteMachineFrameworks
 *
 * @property int $id
 * @property int $order 排序
 * @property string $name 名称
 * @property string|null $description 描述
 * @property string $category 参数分类
 * @property mixed|null $pic 图片
 * @property string|null $select_type 筛选类型
 * @property int|null $child_id 子id  如果child_id 存在则不提供修改
 * @property string|null $child_category 子分类  如果child_category 存在则不提供修改
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\CompleteMachineFrameworks[] $children
 * @property-read \App\Models\CompleteMachineFrameworks|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks d()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereChildCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks wherePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereSelectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachineFrameworks whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompleteMachineFrameworks extends Model
{
     use NodeTrait;
     protected $fillable=['order','name','parent_id','description','category','pic','select_type','child_id','child_category'];

     public function setPicAttribute($value){
         return $this->attributes['pic']=json_encode($value,JSON_UNESCAPED_UNICODE);
     }
    public function getPicAttribute($value){
        return getImages($value);
    }
    public function child(){
        return $this->belongsTo($this,'child_id','id');
    }
    public function good(){
        return $this->belongsTo(CompleteMachine::class,'child_id','id');
    }
    public function it_outsourcings(){
        return $this->belongsTo(ProductGood::class,'child_id','id');
    }
}
