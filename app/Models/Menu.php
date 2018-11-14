<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property string $name 菜单名
 * @property string|null $slug 简码
 * @property mixed|null $pic 图片/图标
 * @property string|null $url 链接
 * @property int $order 排序
 * @property int $parent_id 所属分类
 * @property string $cats 所属栏目
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Menu[] $childMenus
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu condition($cat)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu order()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereCats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu wherePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUrl($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    protected $fillable=['cats','name','slug','url','pic','parent_id'];
    public function childMenus(){
        return $this->hasMany('App\Models\Menu','parent_id','id')->orderBy('order','asc');
    }
    public function scopeCondition($query,$cat)
    {
        return $query->where([
            ['cats','=',$cat],
            ['parent_id','=',0]
        ]);
    }
    public function scopeOrder($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function setPicAttribute($value){
        return $this->attributes['pic']=json_encode($value,JSON_UNESCAPED_UNICODE) ?? '';
    }
    public function getPicAttribute($value){
        return getImages($value);
    }
}
