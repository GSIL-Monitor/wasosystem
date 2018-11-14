<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property int $account
 * @property string $name
 * @property string $password
 * @property int $login_count
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereLoginCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $remember_token Token
 * @property string|null $qq qq号码
 * @property string|null $email 邮箱
 * @property string|null $phone 电话号码
 * @property string|null $entryed_at 入职时间
 * @property string|null $social_securityed_at 社保购买时间
 * @property string|null $pacted_at 合同到期时间
 * @property int|null $rule_id 权限Id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductGood[] $temporary_product_goods
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin role($roles)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEntryedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePactedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereQq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereRuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereSocialSecurityedAt($value)
 */
class Admin extends Authenticatable
{
    use Notifiable,HasRoles;
    protected $guard_name='admin';
    protected $fillable = ['account', 'name', 'login_count','password','login_count','qq','email','phone'];
    protected $hidden=['password','remember_token'];
    public function temporary_product_goods()
    {
        return $this->belongsToMany(ProductGood::Class,
            'temporary_product_goods', 'admin_id', 'product_good_id')
            ->withPivot('product_good_num','product_number','product_good_price','product_good_raid')
            ->with([
                'product',
                'product_goods_admin',
                'framework',
                'series',
                'product.good'=>function($query){
                            return $query->oldest('name');
                         }
                ]);
    }
    public function order()
    {
        return $this->hasMany(Order::Class,'market','account');
    }
    public function funds()
    {
        return $this->hasMany(FundsManagement::Class,'market','account');
    }
    public function users()
    {
        return $this->hasMany(User::Class,'administrator','id');
    }
    public function visitor()
    {
        return $this->hasMany(VisitorDetail::Class,'admin','account');
    }

    public function demand()
    {
        return $this->hasMany(DemandManagement::class,'admin','id');
    }


}
