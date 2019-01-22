<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\Pinyin\Pinyin;

/**
 * App\Models\CompleteMachine
 *
 * @property int $id
 * @property string $name 产品型号
 * @property string $code 配置代码
 * @property array $price 产品价格
 * @property string|null $float 价格浮动
 * @property string $marketing 营销
 * @property array $status 产品状态
 * @property int|null $quality_time 质保时间
 * @property int|null $weight 重量
 * @property array $jiagou 架构类型
 * @property array $additional_arguments 额外参数
 * @property array $application 应用类型
 * @property int|null $sales_volume 销量
 * @property int|null $parent_id 所属产品
 * @property string|null $details 产品详情
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductGood[] $complete_machine_product_goods
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereAdditionalArguments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereApplication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereFloat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereJiagou($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereMarketing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereQualityTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereSalesVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompleteMachine whereWeight($value)
 * @mixin \Eloquent
 */
class CompleteMachine extends Model
{
    protected $casts = ['price' => 'array', 'status' => 'array', 'jiagou' => 'array', 'application' => 'array', 'additional_arguments' => 'array'];
    protected $fillable = ['name', 'code', 'price', 'float', 'marketing', 'status'
        , 'sales_volume', 'quality_time', 'weight', 'jiagou', 'additional_arguments'
        , 'application', 'details', 'parent_id'
    ];

    public function getSearchTypeAttribute()
    {
        return 'completeMachine';
    }
    public static function scopeSiteQuery($query, $condition, $type,$apiCondition=null)
    {
        return $query->with(['complete_machine_product_goods'=>function($query) use ($apiCondition){
            $query->when($apiCondition,function ($query){
                $query->whereIn('product_id',[20,23])->select(['pic']);
            });
        },'favoriteCompleteMachines'])
            ->where('status->show',1)
            ->when($condition, function ($query) use ($condition) {
                $pinyin = new Pinyin('Overtrue\Pinyin\MemoryFileDictLoader');
                $query_condition = strtolower($pinyin->permalink($condition->name, '_'));
                $query->where('jiagou->' . $query_condition, $condition->name);
            }, function ($query) use ($condition, $type) {
                $types = ['complete_machine' => 1, 'storage' => 3, 'graphic_workstation_designer_computer' => 2][$type];
                $query->when($types != 3, function ($query) use ($condition, $types) {
                    $query->when($types == 2, function ($query) use ($types) {
                            $query->where(function ($query) use($types) {
                                $query->orWhere('jiagou->tu_xing_gong_zuo_zhan', '图形工作站')
                                ->orWhere('jiagou->nd7000_xi_lie', 'ND7000系列')
                                ->orWhere('jiagou->nd8000_xi_lie', 'ND8000系列')
                                ->orWhere('jiagou->nd9000_xi_lie', 'ND9000系列')
                                ->orWhere('jiagou->ban_gong_dian_nao_xi_lie', '办公电脑系列');
                        });
                    }, function ($query) use ($types) {
                        $query->where('parent_id', $types)->where(function ($query) {
                            $query->orWhere('jiagou->tong_yong_fu_wu_qi', '通用服务器')
                                ->orWhere('jiagou->shen_du_xue_xi_ren_gong_zhi_neng', '深度学习-人工智能')
                                ->orWhere('jiagou->hpc_gao_xing_neng_yun_suan', 'HPC高性能运算')
                                ->orWhere('jiagou->gao_mi_du_fu_wu_qi', '高密度服务器')
                                ->orWhere('jiagou->qian_ru_shi_fu_wu_qi', '嵌入式服务器')
                                ->orWhere('jiagou->te_shu_ding_zhi', '特殊定制');

                        });
                    });
                }, function ($query) {
                    $query->where('parent_id', 1)->where('jiagou->cun_chu_fu_wu_qi', '存储服务器');
                });
            })
            ->SiteSearchQuery();
    }
    public function siteSearchToCondition()
    {
        $arr = [];

        $filter = request()->input('filter');
        foreach ($filter as $key => $item) {
            foreach ($item as $key2 => $item2) {
                $arr[$key2] = $item2;
            }
        }
        return $arr;
    }
    public  function scopeSiteSearchQuery($query)
    {
        if(request()->has('filter')){
            $filters=$this->siteSearchToCondition();
            return $query->when(array_has($filters,'类型'),function($query) use($filters){
                $pinyin = new Pinyin('Overtrue\Pinyin\MemoryFileDictLoader');
                $query_condition = strtolower($pinyin->permalink($filters['类型'], '_'));
                $query->where('application->' . $query_condition, $filters['类型']);
            })->when(array_has($filters,'价格'),function($query) use($filters){
                $prices=config('site.server_price')[$filters['价格']];
                $query_condition =user()->grades->identifying ?? 'retail_price';
                $query->whereBetween('price->' . $query_condition,[$prices[0],$prices[1]]);
            })->when(array_has($filters,'处理器'),function($query) use($filters){
                $query->whereHas('complete_machine_product_goods', function ($query) use($filters){
                    $query->where('series_name', $filters['处理器']);
                });
            })->when(array_has($filters,'内存类型'),function($query) use($filters){
                $query->whereHas('complete_machine_product_goods', function ($query) use($filters){
                    $query->where([['details->lei_xing', $filters['内存类型'],['product_id',14]]]);
                });
            })->when(array_has($filters,'内存容量'),function($query) use($filters){
                $query->whereHas('complete_machine_product_goods', function ($query) use($filters){
                    $query->where([['details->rong_liang', $filters['内存容量'],['product_id',14]]]);
                });
            })->when(array_has($filters,'硬盘容量'),function($query) use($filters){
                $query->whereHas('complete_machine_product_goods', function ($query) use($filters){
                    $query->where([['details->rong_liang', $filters['硬盘容量'],['product_id',15]]]);
                });
            });
        }
    }

    public function setPriceAttribute($value)
    {
        return $this->attributes['price'] = json_encode($value, JSON_UNESCAPED_UNICODE) ?? '';
    }

    public function setStatusAttribute($value)
    {
        return $this->attributes['status'] = json_encode($value, JSON_UNESCAPED_UNICODE) ?? '';
    }

    public function setJiagouAttribute($value)
    {
        return $this->attributes['jiagou'] = json_encode($value, JSON_UNESCAPED_UNICODE) ?? '';
    }

    public function setApplicationAttribute($value)
    {
        return $this->attributes['application'] = json_encode($value, JSON_UNESCAPED_UNICODE) ?? '';
    }

    public function setAdditional_argumentsAttribute($value)
    {
        return $this->attributes['additional_arguments'] = json_encode($value, JSON_UNESCAPED_UNICODE) ?? '';
    }
    public function UnitPrice()
    {
        $price=user()->grades->identifying ?? 'retail_price';
        return priceSum($this->complete_machine_product_goods)[$price];
    }


    /*----------------获取整机里的物料配件-------------------------*/
    public function complete_machine_product_goods()
    {
        return $this->belongsToMany(ProductGood::Class, 'complete_machine_product_goods', 'complete_machine_id', 'product_good_id')
            ->withPivot('product_good_num', 'product_number')
            ->with(['product']);
    }
    public function favoriteCompleteMachines()
    {
        return $this->belongsToMany(User::class, 'user_favorite_complete_machines')
            ->withTimestamps()
            ->orderBy('user_favorite_complete_machines.created_at', 'desc');
    }
    /*----------------绑定新闻-------------------------*/
    public function information_management_complete_machines()
    {
        return $this->belongsToMany(InformationManagement::Class, 'information_complete_machines');
    }

    public function complete_machine_video()
    {
        return $this->belongsToMany(Video::class,'video_complete_machines');
    }


}