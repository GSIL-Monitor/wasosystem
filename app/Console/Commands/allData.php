<?php

namespace App\Console\Commands;

use App\Models\BarcodeAssociated;
use App\Models\BusinessManagement;
use App\Models\CompleteMachine;
use App\Models\DemandFiltrate;
use App\Models\DemandManagement;
use App\Models\DivisionalManagement;
use App\Models\FundsManagement;
use App\Models\HistoricalTaskManagement;
use App\Models\InformationManagement;
use App\Models\Integration;
use App\Models\IntegrationCategory;
use App\Models\InventoryManagement;
use App\Models\MemberStatus;
use App\Models\Order;
use App\Models\ProcurementPlan;
use App\Models\ProductDrive;
use App\Models\Service;
use App\Models\SupplierManagement;
use App\Models\SupplierRepairAddress;
use App\Models\TaskManagement;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserCompany;
use App\Models\VisitorDetail;
use App\Models\WarehouseOutManagement;
use Illuminate\Console\Command;
use App\Models\Admin;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductFramework;
use App\Models\ProductGood;
use App\Models\ProductParamenter;
use Illuminate\Http\Request;
use App\Http\Requests\AdminsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Overtrue\Pinyin\Pinyin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class allData extends Command
{
    protected $pdo;
    protected $pdo2;
    protected $pinyin;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:alldata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->pdo = \DB::connection('mysql2');
        $this->pdo2 = \DB::connection('mysql3');
        $this->pinyin = new Pinyin('Overtrue\Pinyin\MemoryFileDictLoader');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        set_time_limit(0);
        //手动复制的表 complete_machine_frameworks ,roles,role_has_permissions,model_has_roles,permissions,old_goods,old_orders,old_yingpans
//        $this->admins();//管理员还原
//        $this->menus();//菜单还原
//        $this->roles();//角色权限还原
//         $this->products();//配件还原
//         $this->product_frameworks();//配件架构还原
//         $this->product_paramenters();//配件专有项还原
//         $this->product_goods();//配件产品还原
//         $this->drives();//配件驱动
//         $this->self_build_product_goods();//平台自建产品还原
//        $this->complete_machines();//整机产品还原
//         $this->complete_machine_goods();//整机产品物料还原
//        $this->integrations();//软硬一体化还原
//        $this->members();//会员，会员地址，会员公司还原
//        $this->orders();//订单还原
//        $this->marketing_center();//营销中心还原
//        $this->funds();//资金还原
        $this->businesses();//企业管理
//        $this->informations();//资讯管理
//        $this->suppliers();//供应商管理
//        $this->purchasings();//采购管理
//        $this->inventorys();//库存管理
//        $this->warehouses();//出库管理
//       $this->barcode_associateds();//条码关联管理
//        $this->services();//服务管理
    }

    public function tables($table)
    {
        return $this->pdo->table($table);
    }

    public function table2($table)
    {
        return $this->pdo2->table($table);
    }

    //管理员还原
    public function admins()
    {
        \DB::transaction(function () {
            $this->tables('admin')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new Admin;
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->account = $item->account;
                    $model->password = bcrypt(123456);
                    $model->qq = $item->qq;
                    $model->email = $item->email;
                    $model->phone = $item->tel;
                    if ($item->ruzhitime != -28800) {
                        $model->entryed_at = date('Y-m-d H:i:s', $item->ruzhitime);
                        $model->social_securityed_at = date('Y-m-d H:i:s', $item->sbstarttime);
                        $model->pacted_at = date('Y-m-d H:i:s', $item->htendtime);
                    }
                    $model->login_count = $item->login_count;
                    $model->save();
                });
            });
            $this->info('管理员还原完成！');
        });
    }

    //菜单还原
    public function menus()
    {
        \DB::transaction(function () {
            $this->table2('menus')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new Menu();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->slug = $item->slug;
                    $model->pic = $item->pic;
                    $model->url = $item->url;
                    $model->order = $item->order;
                    $model->parent_id = $item->parent_id;
                    $model->cats = $item->cats;
                    $model->save();
                });
            });
            $this->info('菜单还原完成！');
        });
    }

    //角色权限还原
    public function roles()
    {
        \DB::transaction(function () {
            $this->table2('roles')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new Role();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->title = $item->title;
                    $model->guard_name = $item->guard_name;
                    $model->save();
                });
            });
            $this->info('角色还原完成！');
        });
        \DB::transaction(function () {
            $this->table2('permissions')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new Permission();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->title = $item->title;
                    $model->guard_name = $item->guard_name;
                    $model->save();
                });
            });
            $this->info('权限还原完成！');
        });
    }

    //配件
    public function products()
    {
        \DB::transaction(function () {
            $this->tables('peijian')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new Product;
                    $model->id = $item->id;
                    $model->title = $item->title;
                    $model->bianhao = $item->bianhao;
                    $model->jianma = $item->jianma;
                    $model->save();
                });
            });
            $this->info('配件还原完成！');
        });
    }

    //配件架构
    public function product_frameworks()
    {
        \DB::transaction(function () {
            $this->tables('product')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new ProductFramework();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->product_id = $item->ppid;
                    $model->parent_id = $item->pid;
                    $model->save();
                });
            });
            $this->info('配件架构还原完成！');
        });
    }

    //配件专有项
    public function product_paramenters()
    {
        \DB::transaction(function () {
            $this->tables('proprietary')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new ProductParamenter();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->danwei = $item->danwei;
                    $model->type = $item->tagtype;
                    $model->order = $item->sort;
                    $model->qiantai_show = $item->is_show;
                    $model->admin_show = $item->is_hshow;
                    $model->product_id = $item->sid;
                    $model->parent_id = $item->pid;
                    if (!empty($item->red_id)) {
                        $red_id = explode(',', $item->red_id);
                        $model->parameter_pid = $red_id[0];
                        $model->parameter_id = $red_id[1];
                        $model->show_type = 'paramenters';
                    }
                    if (!empty($item->red_jg_id)) {
                        $model->parameter_id = $item->red_jg_id;
                        $model->show_type = 'framework';
                    }
                    $model->save();
                });
            });
            $this->info('配件专有项还原完成！');
        });
    }

    //产品迁移
    public function product_goods()
    {
        \DB::transaction(function () {
            $this->tables('cpu')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '1,2,3,4,8,5,7,10,6,9,11,12');//cpu
                    $this->info($this->create_good($item, $parameter));
                });
            });
            $this->info('CPU配件产品还原完成！');
            $this->tables('zhuban')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '15,13,22,14,19,16,21,18,20,17,24,23,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,42,41,43,44,45,46,47,689');//主板
                    $this->info($this->create_good($item, $parameter));;
                });
            });
            $this->info('主板配件产品还原完成！');
            $this->tables('neicun')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '48,57,49,54,55,52,53,58,50,51,56');//内存
                    $this->info($this->create_good($item, $parameter));
                });
            });
            $this->info('内存配件产品还原完成！');
            $this->tables('yingpan')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '59,61,62,60,64,65,63,66');//硬盘
                    $this->info($this->create_good($item, $parameter));;
                });
            });
            $this->info('硬盘配件产品还原完成！');
            $this->tables('xianka')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '75,77,79,80,76,78,81,82');//显卡
                    $this->info($this->create_good($item, $parameter));;
                });
            });
            $this->info('显卡配件产品还原完成！');
            $this->tables('zhenlie')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '72,68,67,656,70,71,73,69,74');//阵列卡
                    $this->info($this->create_good($item, $parameter));;
                });
            });
            $this->info('阵列卡配件产品还原完成！');
            $this->tables('wangka')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '83,86,85,87,84,88');//网卡
                    $this->info($this->create_good($item, $parameter));;

                });
            });
            $this->info('网卡配件产品还原完成！');
            $this->tables('zhuanyong')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '89,91');//专用卡
                    $this->info($this->create_good($item, $parameter));;
                });
            });
            $this->info('专用卡配件产品还原完成！');
            $this->tables('jixiang')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '92,93,95,96,97,101,102,99,100,98,104,105,94,103,693');//机箱
                    $this->info($this->create_good($item, $parameter));;
                });
            });
            $this->info('机箱配件产品还原完成！');
            $this->tables('dianyuan')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '106,107,109,110,108,691,692,738');//电源
                    $this->info($this->create_good($item, $parameter));;
                });
            });
            $this->info('电源配件产品还原完成！');
            $this->tables('sanre')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '112,113,114,115,680,684,116');//散热器
                    $this->info($this->create_good($item, $parameter));
                });
            });
            $this->info('散热器配件产品还原完成！');
            $this->tables('pingtai')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', "119,120,129,130,122,121,128,124,127,125,123,126,131,132,133,134,135,136,137,153,155,154,144,145,138,139,140,141,142,143,560,561,562,146,147,148,555,150,151,156,157,149,152,654,655,687,690,710,711"); //平台
                    $this->info($this->create_good($item, $parameter));
                });
            });
            $this->info('平台配件产品还原完成！');
            $this->tables('qita')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '');//其他
                    $this->info($this->create_good($item, $parameter));
                });
            });
            $this->info('其他配件产品还原完成！');
        });

    }

    public function create_good($item, $parameter)
    {
        $model = new ProductGood();
        $model->oldid = $item->id;
        $model->product_id = $item->b10;
        $model->jiagou_id = $item->b6;
        $model->xilie_id = $item->b8;
        $model->name = $item->a1;
        $model->jiancheng = $item->a2;
        $model->jianma = $item->a3;
        $model->daima = $item->yuanchangdaima;
        $model->price = ['retail_price' => $item->a6,
            'member_price' => $item->a7,
            'cooperation_price' => $item->a8,
            'core_price' => $item->a9,
            'cost_price' => $item->a5,
            'taobao_price' => $item->a21
        ];
        $model->status = ['show' => $item->a10 == 1 ? 0 : 1,
            'main_current' => $item->a11 == 1 ? 0 : 1,
            'recommend' => $item->a12 == 1 ? 0 : 1,
            'halt_production' => $item->a13 == 1 ? 0 : 1,
            'hot' => $item->a14 == 1 ? 0 : 1,
            'hide' => $item->a15 == 1 ? 0 : 1
        ];
        $model->quality_time = $item->a4;
        $model->series_name = $item->b9;
        $model->framework_name = $item->b7;
     //   $model->pic = explode(';',$item->a18);
        $pics=array_filter(explode(';',$item->a18));
        if(!empty($pics) && ($item->b10 == 20 || $item->b10 == 23 || $item->b10 == 24)){
            $arr=[];
            foreach ($pics as $key=>$pic){
                $arr['url'][$key]=$pic;
                $arr['name'][$key]=str_before(str_after($pic,'/'),'.');
            }
            $model->pic = $arr;
       //
        }
        if (!empty(array_filter($parameter))) {
            foreach ($parameter as $k => $v) {
                $p = new ProductParamenter;
                $pn = $p->find($v);
                $k++;
                $b = 'g' . $k;
                $va = explode(',', $item->$b);
                if (count($va) >= 1 && $pn->type == 'checkbox') {
                    $c[strtolower($this->pinyin->permalink($pn->name, '_'))] = $va;
                } elseif (count($va) >= 1 && $pn->type == 'radio') {
                    $c[strtolower($this->pinyin->permalink($pn->name, '_'))] = $item->$b == 2 ? 0 : 1;
                } else {
                    if ($item->$b == '') {
                        $c[strtolower($this->pinyin->permalink($pn->name, '_'))] = null;
                    } else {
                        $c[strtolower($this->pinyin->permalink($pn->name, '_'))] = $item->$b;
                    }
                }
            }
            $model->details = $c;
        }
        if($item->b10 == 24){
            $model->details=[
                'cooperation_types'=>$item->hzlx,
                'product_base'=>$item->jishu,
                'tally'=>$item->danwei,
                'description'=>$item->danwei,
            ];
        }
        $model->save();
    }
    //配件驱动
    public function drives()
    {
        \DB::transaction(function () {
            $this->tables('qudong')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new ProductDrive();
                    $good=ProductGood::whereProductId($item->pid)->whereOldid($item->cpid)->first();
                    if($item->xlid && empty($item->cpid)){
                        $model->product_frame_works_id=$item->xlid;
                        $model->product_good_id=0;
                    }else{
                        if($good ){
                            $model->product_good_id=$good->id;
                        }
                    }

                    $model->file =[
                        'url'=>'files/'.str_after($item->rar,'./public/Uploads/'),
                        'name'=>$item->name
                    ];
                    $model->created_at=date('Y-m-d H:i:s',$item->time);
                    $model->updated_at=date('Y-m-d H:i:s',$item->time);
                    $model->save();
                });
            });
            $this->info('配件驱动还原完成！');
        });
    }
    //平台自建产品
    public function self_build_product_goods()
    {
        \DB::transaction(function () {
            $this->tables('pingtaiwl')->oldest('wliaoid')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new ProductGood();
                    $pingtai = $model->whereProductId(23)->whereOldid($item->pid)->first();
                    $material = $model->whereProductId($item->type)->whereOldid($item->cpid)->first();
                    if ($pingtai && $material) {
                        $pingtai->product_goods_self_build_terrace()->attach($material->id, ['product_good_num' => $item->num, 'product_number' => $item->bianhao]);
                    }
                });
            });
            $this->info('平台自建产品还原完成！');
        });
    }

    //整机产品
    public function complete_machines()
    {
        \DB::transaction(function () {
            $this->tables('zjcp')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new CompleteMachine();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->code = $item->peizhi;
                    foreach (explode(',', $item->cat) as $v) {
                        $jiagou[strtolower($this->pinyin->permalink($v, '_'))] = $v;
                    }
                    $model->jiagou = $jiagou;
                    if (!empty($item->gnms)) {
                        foreach (explode(',', $item->gnms) as $v) {
                            $application[strtolower($this->pinyin->permalink($v, '_'))] = $v;
                        }
                    } else {
                        foreach (explode(',', $item->sxcs) as $v) {
                            $application[strtolower($this->pinyin->permalink($v, '_'))] = $v;
                        }
                    }
                    $model->application = $application;
                    $model->price = ['retail_price' => $item->jiage1,
                        'member_price' => $item->jiage2,
                        'cooperation_price' => $item->jiage3,
                        'core_price' => $item->jiage4,
                        'cost_price' => $item->jiage,
                        'taobao_price' => $item->wsjiage
                    ];
                    $model->additional_arguments = ['mm' => $item->guige,
                        'product_description' => $item->canshu,
                        'humidity' => $item->shidu,
                        'system' => $item->xitong,
                        'page_description' => $item->miaoshu,

                    ];
                    $model->status = ['show' => $item->is_post == 2 ? 1 : 0,
                        'recommend' => $item->tuijian == 2 ? 1 : 0,
                    ];
                    $model->weight = is_numeric($item->qita) ? $item->qita : 0;
                    if ($item->yingxiao == 0) {
                        $model->marketing = 'none';
                    } elseif ($item->yingxiao == 1) {
                        $model->marketing = 'new';
                    } elseif ($item->yingxiao == 2) {
                        $model->marketing = 'hot';
                    } elseif ($item->yingxiao == 3) {
                        $model->marketing = 'moods';
                    } elseif ($item->yingxiao == 4) {
                        $model->marketing = 'sale';
                    }
                    $model->quality_time = $item->zhibao;
                    $model->details = $item->content;
                    $model->parent_id = $item->type;
                    $model->save();
                });
            });
            $this->info('整机产品还原完成！');
        });
    }

    //整机产品物料
    public function complete_machine_goods()
    {
        \DB::transaction(function () {
            $this->tables('zjlswl')->oldest('wliaoid')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new CompleteMachine;
                    $complete_machine = $model->find($item->zjid);
                    $good = new ProductGood;
                    $gd = $good->whereProductId($item->type)->whereOldid($item->cpid)->first();
                    if ($complete_machine && $gd) {
                        $complete_machine->complete_machine_product_goods()->attach($gd->id, ['product_good_num' => $item->num, 'product_number' => $item->bianhao]);
                    }
                });
            });
            $this->info('整机产品物料还原完成！');
        });
    }

    //软硬一体化
    public function integrations()
    {
        \DB::transaction(function () {
            $this->table2('integration_categories')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new IntegrationCategory();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->pic = json_decode($item->pic, true);
                    $model->save();
                });
            });
            $this->table2('integrations')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new Integration();
                    $model->id = $item->id;
                    $model->parent_id = $item->parent_id;
                    $model->click = $item->click;
                    $model->name = $item->name;
                    $model->pic = json_decode($item->pic, true);
                    $model->description = $item->description;
                    $model->show = $item->show;
                    $model->details = $item->details;
                    $model->save();
                });
            });
            $this->info('软硬一体化分类还原完成！');
            $this->info('软硬一体化还原完成！');
        });
    }

    //会员
    public function members()
    {
        \DB::transaction(function () {
            //会员状态
            $this->table2('member_statuses')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new MemberStatus();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->identifying = $item->identifying;
                    $model->type = $item->type;
                    $model->parent_id = $item->parent_id;
                    $model->save();
                });
            });
            $this->info('会员状态还原完成！');
            //会员
            $this->tables('users')->oldest('userid')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new User();
                    $model->id = $item->userid;
                    $model->oid = $item->oldid ?? 0;
                    $model->unit = $item->dwjc;
                    $model->username = $item->username;
                    $model->nickname = $item->nickname;
                    $model->password = bcrypt($item->c);
                    $model->clear_text = encrypt($item->c);
                    $model->sex = $item->sex == 1 ? 'Mr' : $item->sex == 2 ? 'lady' : 'privary';
                    $model->birthday = $item->borthday;
                    $model->phone = $item->mobile;
                    $model->telephone = $item->telephone;
                    $model->email = $item->email;
                    $model->wechat = $item->weixin;
                    $model->qq = $item->qq;
                    $model->industry = $item->hangye;
                    $model->address = $item->address;
                    if ($item->vip == 12) {
                        $model->grade = 'unverified';
                    }//未认证
                    if ($item->vip == 10) {
                        $model->grade = 'blocked_account';
                    }//冻结账户
                    if ($item->vip == 1) {
                        $model->grade = 'retail_price';
                    }//零售价格
                    if ($item->vip == 11) {
                        $model->grade = 'taobao_price';
                    }// 淘宝价
                    if ($item->vip == 2 || $item->vip == 6) {
                        $model->grade = 'member_price';
                    }////会员价
                    if ($item->vip == 3 || $item->vip == 7) {
                        $model->grade = 'cooperation_price';
                    }//合作价
                    if ($item->vip == 4 || $item->vip == 8) {
                        $model->grade = 'core_price';
                    }//核心价
                    if ($item->vip == 5 || $item->vip == 9) {
                        $model->grade = 'cost_price';
                    }//成本价
                    if ($item->kefu != null || $item->kefu != '') {
                        $admin = Admin::whereAccount($item->kefu)->first();
                        $model->administrator = $admin->id;
                    } else {
                        $model->administrator = 0;
                    }
                    $model->payment_days = $item->zhangqi;
                    $model->tax_rate = $item->shuidian == 50 ? 1 : 10;
                    if ($item->infotype == 1) {
                        $model->message_type = 'phone_receiving';
                    }
                    if ($item->infotype == 2) {
                        $model->message_type = 'email_receiving';
                    }
                    if ($item->infotype == 3) {
                        $model->message_type = 'all_receiving';
                    }
                    if ($item->infotype == 4) {
                        $model->message_type = 'no_receiving';
                    }
                    $model->parts_buy = $item->is_peijian == 1 ? 0 : 1;
                    $model->register_ip = $item->regip;
                    $model->last_login_ip = $item->lastip;
                    $model->login_count = $item->loginnum;
                    $model->last_login_time = date('Y-m-d H:i:s', $item->lastdate);
                    $model->deal = $item->chengjiao == 1 ? 1 : 0;
                    $model->avatar = [];
                    $model->parameters = [];
                    $model->created_at = date('Y-m-d H:i:s', $item->regdate);
                    $model->save();
                });
            });
            $this->info('会员还原完成！');
            //会员地址[['name','<>','未添加单位'],['name','<>',null]]
            $this->tables('wlinfo')->where(function ($query) {
                $query->where('shouhuoren', '<>', '未添加地址')->where('shouhuoren', '<>', null);
            })->oldest('wlid')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new UserAddress();
                    $a = User::whereId($item->userid)->first();
                    if ($a) {
                        $model->id = $item->wlid;
                        $model->user_id = $item->userid;
                        $model->address = $item->address;
                        $model->name = $item->shouhuoren;
                        $model->phone = $item->tel;
                        $model->alternative_phone = $item->bytel;
                        $model->logistics = $item->wlzhiding;
                        $model->default = $item->status == 1 ? false : true;
                        $model->number = $item->bianhao;
                        $model->zip = $item->youbian;
                        $model->save();
                    }
                });
            });
            $this->info('会员地址还原完成！');
            //会员公司地址
            $this->tables('qiyeinfo')->where(function ($query) {
                $query->where('name', '<>', '未添加单位')->where('name', '<>', null);
            })->oldest('qiyeid')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new UserCompany();
                    $a = User::whereId($item->userid)->first();
                    $invoice = MemberStatus::whereType('invoice')->pluck('identifying', 'name')->toArray();
                    if ($a) {
                        $model->id = $item->qiyeid;
                        $model->user_id = $item->userid;
                        $model->address = $item->address;
                        $model->name = $item->name;
                        $model->unit = $item->dwjc;
                        $model->unit_code = $item->dwjm;
                        $model->unit_phone = $item->tel;
                        $model->fax = $item->ctel;
                        $model->zip = $item->youbian;
                        $model->url = $item->url;
                        $model->tax_mode = $invoice[$item->shuimoshi] ?? 'no_invoice';
                        $model->tax_number = $item->shuihao;
                        $model->account = $item->zhanghao;
                        $model->opening_bank = $item->kaihuhang;
                        $model->bank_address = $item->khhaddress;
                        $model->bank_phone = $item->khhtel;
                        $model->finance = $item->caiwu;
                        $model->finance_phone = $item->cwtel;
                        $model->logistics = $item->zhiding;
                        $model->number = $item->bianhao;
                        $model->default = $item->status == 1 ? false : true;
                        $model->save();
                    }
                });
            });
            $this->info('会员公司地址还原完成！');
        });
    }

    //订单
    public function orders()
    {

        \DB::transaction(function () {
            //需求筛选还原
            $this->tables('orders')->oldest('orderid')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new Order();
                    $model->id = $item->orderid;
                    $model->user_id = $item->userid;
                    if ($item->userid) {
                        $user = User::whereId($item->userid)->first();
                        if ($user) {
                            $model->serial_number = $item->orderhao;
                            $model->machine_model = $item->xinghao;
                            $model->code = $item->peizhi;
                            $model->unit_price = $item->danjia == null ? 0 : $item->danjia;
                            $model->total_prices = $item->price == null ? 0 : $item->price;
                            $model->price_spread = $item->chae;
                            $model->num = $item->dgshu;
                            if ($item->orderms == 1) {
                                $model->order_type = 'parts';
                            }
                            if ($item->orderms == 2) {
                                $model->order_type = 'waso_complete_machine';
                            }
                            if ($item->orderms == 3) {
                                $model->order_type = 'custom_complete_machine';
                            }
                            if ($item->orderms == 4) {
                                $model->order_type = 'designer_computer';
                            }
                            if ($item->orderstatus == 0 || $item->orderstatus == '0') {
                                $model->order_status = 'intention_to_order';
                            }
                            if ($item->orderstatus == 1 || $item->orderstatus == '1') {
                                $model->order_status = 'placing_orders';
                            }
                            if ($item->orderstatus == 2 || $item->orderstatus == '2') {
                                $model->order_status = 'order_acceptance';
                            }
                            if ($item->orderstatus == 3 || $item->orderstatus == '3') {
                                $model->order_status = 'in_transportation';
                            }
                            if ($item->orderstatus == 4 || $item->orderstatus == '4') {
                                $model->order_status = 'arrival_of_goods';
                            }

                            if ($item->send == 0) {
                                $model->message_status = 'intention_to_order';
                            }
                            if ($item->send == 1) {
                                $model->message_status = 'placing_orders';
                            }
                            if ($item->send == 2) {
                                $model->message_status = 'order_acceptance';
                            }
                            if ($item->send == 3) {
                                $model->message_status = 'in_transportation';
                            }

                            if ($item->kxstatus == 0) {
                                $model->payment_status = 'pay_first';
                            }
                            if ($item->kxstatus == 1) {
                                $model->payment_status = 'pay_on_delivery';
                            }
                            if ($item->kxstatus == 2) {
                                $model->payment_status = 'taobao_pay';
                            }
                            if ($item->kxstatus == 3) {
                                $model->payment_status = 'payment_days_user';
                            }
                            if ($item->kxstatus == 4) {
                                $model->payment_status = 'pay_in_advance';
                            }
                            if ($item->kxstatus == 5) {
                                $model->payment_status = 'account_paid';
                            }

                            if ($item->fwstatus == 0) {
                                $model->service_status = 0;
                            }
                            if ($item->fwstatus == 1) {
                                $model->service_status = 400;
                            }
                            if ($item->fwstatus == 2) {
                                $model->service_status = 1200;
                            }
                            if ($item->fwstatus == 3) {
                                $model->service_status = 3600;
                            }

                            if (empty($item->fptype)) {
                                $model->invoice_type = 'no_invoice';
                            }
                            if ($item->fptype == 1) {
                                $model->invoice_type = 'tax_invoice';
                            }
                            if ($item->fptype == 2) {
                                $model->invoice_type = 'vat_special_invoice';
                            }

                            $model->invoice_info = $item->fpinfo;
                            $model->logistics_id = $item->wladdress == null ? 0 : $item->wladdress;
                            $model->logistics_info = $item->wlinfo;
                            $model->parcel_count = $item->jiannum;
                            $model->user_remark = $item->ddyaoqiu;
                            $model->company_remark = $item->des;
                            $model->urgent = $item->is_jiaji == 1 ? true : false;
                            $model->flow_pic = $item->is_picshow == 1 ? true : false;
                            $model->in_common_use = $item->changyong == 2 ? true : false;
                            $model->pic = $item->dpic ? explode(';', $item->dpic) : [];
                            $model->market = $item->xiaoshou;
                            $shoulis=[];
                            $jishus=[];
                            $dabaos=[];
                            if(!empty($item->shouli)){
                                $shoulis=explode('/', $item->shouli);
                                 foreach ($shoulis as $key=>$shouli){
                                     $shoulis[$key]=trim($shouli);
                                 }
                            }
                            if(!empty($item->jishu)){
                                $jishus=explode('/', $item->jishu);
                                foreach ($jishus as $key=>$jishu){
                                    $jishus[$key]=trim($jishu);
                                }
                            }
                            if(!empty($item->dabao)){
                                $dabaos=explode('/', $item->jishu);
                                foreach ($dabaos as $key=>$dabao){
                                    $dabaos[$key]=trim($dabao);
                                }
                            }
                            $model->participation_admin = [
                                'acceptance' => $shoulis,
                                'skill' => $jishus,
                                'pack' =>$dabaos,
                            ];
                            $model->admin = $item->admin;
                            $model->created_at = date('Y-m-d H:i:s', $item->tjordertime);
                            $model->updated_at = $item->edittime == null ? date('Y-m-d H:i:s', $item->tjordertime) : date('Y-m-d H:i:s', $item->edittime);
                            $model->deleted_at = $item->is_del == 2 ? date('Y-m-d H:i:s', time()) : null;
                            $model->save();
                        }

                    }
                });
            });
            $this->info('订单还原完成！');
            $this->tables('orderwl')->oldest('wliaoid')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new Order();
                    $good = new ProductGood();
                    if ($item->orderid) {
                        $order = $model->find($item->orderid);
                        $order_good = $good->with('product')->whereProductId($item->type)->whereOldid($item->cpid)->first();
                        if ($order && $order_good) {
                            $order->order_product_goods()->attach($order_good->id, ['product_good_price' => $item->danjia ?? 0, 'product_good_num' => $item->num, 'product_number' => $order_good->product->bianhao, 'product_good_raid' => $item->raid]);
                        }
                    }
                });
            });
            $this->info('订单物料还原完成！');
        });
    }

    //营销中心
    public function marketing_center()
    {
        \DB::transaction(function () {
//            //客情还原
            $this->tables('jilu')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new VisitorDetail();
                    if ($item->userid) {
                        $user = User::whereId($item->userid)->first();
                        if ($user) {
                            $model->id = $item->id;
                            $model->user_id = $user->id;
                            $model->source = $item->laiyuan;
                            $model->nickname = $item->nickname;
                            $model->industry = $item->hangye;
                            $model->address = $item->address;
                            $model->search = $item->sousuoci;
                            $model->key = $item->guanjianci;
                            $model->phone = $item->mobile;
                            $model->email = $item->email;
                            $model->wechat = $item->weixin;
                            $model->qq = $item->qq;
                            $model->admin = $item->admin;
                            $model->details = $item->des;
                            $model->contact_count = $item->lianxi == 1 ? 'one' : 'two';
                            $model->valid = $item->youxiao == 1 ? 'no' : 'yes';
                            $model->created_at = $item->fwtime;
                            $model->save();
                            $user->visitor_details()->update($user->only(["nickname",
                                "industry",
                                "address",
                                "phone",
                                "email",
                                "wechat",
                                "qq"
                            ]));
                        }
                    }
                });
            });
            $this->info('客情还原完成！');
            //需求筛选还原
            $this->tables('dzshaixuan')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new DemandFiltrate();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->parent_id = $item->pid;
                    $model->category = $item->type === 1 ? 'issue' : 'answer';
                    $model->save();
                });
            });
            $this->info('需求筛选还原完成！');
            //需求还原
            $this->tables('peizhi')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new DemandManagement();
                    $model->id = $item->id;
                    if ($item->userid) {
                        $user = User::find($item->userid);
                        $visitor_details = VisitorDetail::find($item->zxid);
                        if (!empty($user) && empty($user->visitor_details) && empty($visitor_details)) {
                            $VisitorDetailData = $user->only(["nickname",
                                "industry",
                                "address",
                                "phone",
                                "email",
                                "wechat",
                                "qq"
                            ]);
                            $VisitorDetailData['source'] = '老客户';
                            $VisitorDetailData['valid'] = 'yes';
                            $VisitorDetailData['user_id'] = $user->id;
                            $VisitorDetailData['admin'] = $user->admins->account;
                            $visitor_details = VisitorDetail::create($VisitorDetailData);
                        }
                        if (!empty($user)) {
                            $model->user_id = $user->id;
                            $model->visitor_details_id = $visitor_details->id ?? $user->visitor_details->id;
                            $model->demand_number = $item->hao;
                            if ($item->peizhi) {
                                $model->collocate = json_decode($item->peizhi, true);
                            } else {
                                $model->collocate = [];
                            }
                            $model->explain = $item->shuoming;
                            $model->budget = $item->yusuan;
                            if ($item->status == 1) {
                                $model->demand_status = 'demand_consult';
                            }
                            if ($item->status == 2) {
                                $model->demand_status = 'preliminary_scheme';
                            }
                            if ($item->status == 3) {
                                $model->demand_status = 'requirement_determination';
                            }
                            $model->customer_status = $this->getParameters()['order_type_code'][$item->kehustatus];
                            $model->the_next_step_program = $item->next;
                            $model->record = $item->des;
                            if ($item->xietong) {
                                $model->assistant = json_decode($item->xietong, true);
                            } else {
                                $model->assistant = [];
                            }

                            $model->analog_data = $item->shuju;
                            if ($item->admin) {
                                $admin = Admin::whereAccount($item->admin)->first();
                                $model->admin = $admin->id;
                            }
                            if ($item->addtime) {
                                $model->created_at = date('Y-m-d H:i:s', $item->addtime);
                            }
                            if ($item->edittime) {
                                $model->updated_at = date('Y-m-d H:i:s', $item->edittime);
                            }

                            $model->save();
                            if ($item->shaixuan) {
                                $shaixuan = explode(',', $item->shaixuan);
                                $c = DemandFiltrate::whereIN('id', $shaixuan)->get()->implode('id', ',');
                                $d = array_filter(explode(',', $c));
                                if ($d) {
                                    $model->demand_management_filtrate()->sync($d);
                                }
                            }
                            if ($item->sn) {
                                $a = $this->tables('orders')->whereIN('zxhao', array_wrap($item->hao))->get()->implode('orderid', ',');
                                $d = array_filter(explode(',', $a));
                                if ($d) {
                                    $e = Order::whereIN('id', $d)->get()->implode('id', ',');
                                    $f = array_filter(explode(',', $e));
                                    if ($e) {
                                        $model->demand_management_order()->sync($f);
                                    }
                                }
                            }
                        }
                    }
                });
            });
            $this->info('需求还原完成！');
            //部门管理还原
            $this->tables('ybumen')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new DivisionalManagement();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->parent_id = $item->pid;
                    if ($item->status == 1) {
                        $model->identifying = 'company';
                    }
                    if ($item->status == 2) {
                        $model->identifying = 'department';
                    }
                    if ($item->status == 3) {
                        $model->identifying = 'group';
                    }
                    $model->save();
                });
            });
            $this->info('部门管理还原完成！');
            //部门成员管理还原
            $this->tables('ybumen')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    if (!empty($item->chengyuan)) {
                        $admin = Admin::whereIn('account', explode(';', $item->chengyuan))->get();
                        if ($admin->isNotEmpty()) {
                            foreach ($admin as $value) {
                                $model = new DivisionalManagement();
                                $model->name = $value->name;
                                $model->parent_id = $item->id;
                                $model->admin_id = $value->id;
                                $model->identifying = 'member';
                                $model->save();
                            }
                        }
                    }
                });
            });
            $this->info('部门成员管理还原完成！');
        });
    }

    //资金还原
    public function funds()
    {
        \DB::transaction(function () {
            //会员资金
            $this->tables('funds')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new FundsManagement();
                    $user = User::whereUsername($item->userid)->first();
                    if ($user) {
                        $model->user_id = $user->id;
                        $model->market = $user->admins->account;
                        if (str_contains($item->content, ['订单的定金!'])) {
                            $model->type = 'down_payment';
                        } else {
                            if ($item->lb == 0) {
                                $model->type = 'deposit';
                            }
                            if ($item->lb == 2) {
                                $model->type = 'pay';
                            }
                        }

                        $model->price = $item->money == '' ? 0 : abs($item->money);
                        $model->created_at = $item->S_date;
                        $model->comment = $item->content;
                        if (str_contains($item->admin, 808)) {
                            $model->operate = 808;
                        } else {
                            $model->operate = 809;
                        }
                        $model->save();
                    }
                });
            });
            $this->info('会员资金还原完成！');
        });
    }

    //企业管理
    public function businesses()
    {
        \DB::transaction(function () {
            //企业管理
//            $this->tables('business')->oldest('id')->chunk(100, function ($item) {
//                $item->each(function ($item, $key) {
//                    $model = new BusinessManagement();
//                    if ($item->pname == 'renzheng') {
//                        $model->id = $item->id;
//                        $model->type = 'honor';
//                        $model->sort = $item->sort;
//                        $model->top = $item->top == 1 ? false : true;
//                        $model->field = [
//                            'year' => $item->year,
//                            'name' => $item->name,
//                        ];
//                        if($item->pic){
//                            $model->pic = [
//                                'url'=>[$item->pic],
//                                'name'=>[str_before(str_after($item->pic,'/'),'.')]
//                            ];
//                        }
//                        $model->save();
//                    }
//
//                });
//            });
//            $this->info('企业管理还原完成！');
            $this->tables('service')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new BusinessManagement();
                        $model->id = $item->id;
                        $model->type = 'service_directory';
                        $model->top = 1;
                        $model->field = [
                            'type' => config('status.business_management_category')[$item->pid],
                            'name' => $item->name,
                            'content'=> $item->content,
                        ];
                        $model->save();
                });
            });
            $this->info('服务帮助还原完成！');
        });
    }

    //资讯管理
    public function informations()
    {
        \DB::transaction(function () {
            $this->tables('news')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new InformationManagement();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    if ($item->pname == 'gongsi') {
                        $model->type = 'company_dynamic';
                    }
                    if ($item->pname == 'hangye') {
                        $model->type = 'industry_trends';
                    }
                    if ($item->pname == 'jishu') {
                        $model->type = 'technical_expertise';
                    }
                    $model->description = $item->zhaiyao;
                    $model->marketing = [
                        'show' => $item->is_post == 1 ? 1 : 0,
                        'original' => $item->yuanchuang == 1 ? 1 : 0,
                        'hot' => $item->remen == 1 ? 1 : 0,
                        'boutique' => $item->jingpin == 1 ? 1 : 0,
                        'choiceness' => $item->jingxuan == 1 ? 1 : 0,
                        //'send' => $item->is_send == 2 ? 1 : 0,
                    ];
                    if($item->pic){
                        $model->pic = [
                            'url'=>[$item->pic],
                            'name'=>[str_before(str_after($item->pic,'/'),'.')]
                        ];
                    }


                    $model->content = $item->content;
                    $model->read_count = $item->click;
                    $model->created_at = date('Y-m-d H:i:s', $item->time);
                   $model->save();
                });
            });
            $this->info('企业管理还原完成！');
        });
    }

    //供应商管理
    public function suppliers()
    {
        \DB::transaction(function () {
            $this->tables('tgongyingshang')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new SupplierManagement();
                    $model->id = $item->id;
                    $model->name = $item->name;
                    $model->code = $item->jianma;
                    $model->phone = $item->tel;
                    $model->address = $item->address;
                    $admin = Admin::whereAccount($item->admin)->first();
                    $model->admin = $admin->id;
                    $model->linkman = $admin->user;
                    $model->sales_return_count= $item->thsum;
                    $model->factory_return_count= $item->fxsum;
                    $model->save();
                });
            });
            $this->info('供应商管理还原完成！');
            $this->tables('tgaddress')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $Supplier = SupplierManagement::find($item->gid);
                    $model = new SupplierRepairAddress();
                    if ($Supplier) {
                        $model->supplier_managements_id = $Supplier->id;
                        $model->address = $item->address;
                        $model->name = $item->user;
                        $model->phone = $item->tel;
                        $model->email = $item->email;
                        $model->admin = $item->admin;
                        $model->created_at = date('Y-m-d H:i:s', $item->addtime);
                        $model->save();
                    }
                });
            });
            $this->info('供应商返修地址管理还原完成！');
        });
    }

    //采购管理
    public function purchasings()
    {
        \DB::transaction(function () {
            $this->tables('tin')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new ProcurementPlan();
                    $good = ProductGood::whereProductId($item->cplx)->whereOldid($item->cpgg)->first();
                    $ghdw = SupplierManagement::whereId($item->ghdw)->first();
                    if ($good && $ghdw && $item->yghao) {
                        $model->id = $item->id;
                        $model->supplier_managements_id = $ghdw->id;
                        $model->serial_number = $item->yghao;
                        if ($item->cglx == 1) {
                            $model->procurement_type = 'procurement';
                        } else {
                            $model->procurement_type = 'test';
                        }
                        $model->product_id = $item->cplx;
                        $model->product_good_id = $good->id;
                        $model->quality_time = (int)$item->zbsj;
                        $cgry = Admin::whereAccount($item->cgry)->first();
                        $model->purchase = $cgry->id;
                        $czry = Admin::whereAccount($item->cgry)->first();
                        $model->admin = $czry->id;
                        if ($item->cpcs == 6) {
                            $model->product_colour = 'new';
                        }
                        if ($item->cpcs == 7) {
                            $model->product_colour = 'good';
                        }
                        if ($item->cpcs == 8) {
                            $model->product_colour = 'bad';
                        }
                        if ($item->rkzt == 1) {
                            $model->procurement_status = 'procurement';
                        }
                        if ($item->rkzt == 2) {
                            $model->procurement_status = 'unfinished';
                        }
                        if ($item->rkzt == 3) {
                            $model->procurement_status = 'finish';
                        }
                        $model->postscript = $item->bzxx;
                        $model->procurement_number = $item->cgsl;
                        $model->finish_procurement_number = $item->glsl;
                        $model->logistics_company = $item->wlgs;
                        $model->logistics_number = $item->wldh;
                        $model->code = explode(',', $item->tiaoma);
                        $model->two_code = explode(',', $item->ejtm);
                        $model->created_at = date('Y-m-d H:i:s', $item->addtime);
                        $model->updated_at = date('Y-m-d H:i:s', $item->edittime);
                        $model->save();
                    }
                });
            });
            $this->info('采购管理管理还原完成！');
        });
    }

    //库存管理
    public function inventorys()
    {
        \DB::transaction(function () {
            $this->tables('tkucun')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new InventoryManagement();
                    $good = ProductGood::whereProductId($item->cplx)->whereOldid($item->cpgg)->first();
                    if ($good) {
                        $model->product_id = $item->cplx;
                        $model->product_good_id = $good->id;
                        $model->new = $item->xpsl >= 0 ? $item->xpsl : 0;
                        $model->good = $item->lpsl >= 0 ? $item->lpsl : 0;
                        $model->bad = $item->hhsl >= 0 ? $item->hhsl : 0;
                        $model->return_factory = $item->fcsl >= 0 ? $item->fcsl : 0;
                        $model->proxies = $item->dgsl >= 0 ? $item->dgsl : 0;
                        $model->test = $item->cspsl >= 0 ? $item->cspsl : 0;
                        $model->warning = $item->bjx >= 0 ? $item->bjx : 0;
                        $model->save();
                    }
                });
            });
            $this->info('库存管理还原完成！');
        });
    }

    //出库管理
    public function warehouses()
    {
        \DB::transaction(function () {
            $this->tables('tout')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new WarehouseOutManagement();
                    $code = explode(',', $item->tiaoma);
                    $cps = explode(';', $item->cps);
                    $arr = [];
                    $num = 0;
                    $flag = 0;
                    foreach ($cps as $v) {
                        $a = explode(',', $v);
                        if (count($a) == 3) {
                            $good = ProductGood::whereProductId($a[0])->whereOldid($a[1])->first();
                            if ($good) {
                                $arr[$good->id]['product_good_id'] = $good->id;
                                $arr[$good->id]['product_good_num'] = $a[2];
                                $arr[$good->id]['product_good_number'] = $good->product->bianhao;
                                $tm = array_slice($code, $num, $a[2]);
                                $num += $a[2];
                                $arr[$good->id]['code'] = $tm;
                            } else {
                                $flag = 1;
                            }
                        }
                    }
                    $user = User::find($item->userid);
                    if ($flag == 0 && $user) {
                        $admin = Admin::whereAccount($item->czry)->first();
                        $model->id = $item->id;
                        $model->user_id = $user->id;
                        $model->order_id = $item->orderid ?? 0;
                        $model->serial_number = $item->orderhao;
                        $model->out_number = $item->cksl;
                        $model->finish_out_number = count(array_filter(explode(',', $item->tiaoma)));
                        $model->admin = $admin->id;
                        $model->postscript = $item->bzxx;
                        if ($item->cklb == 3) {
                            $model->out_type = 'sell';
                        }
                        if ($item->cklb == 4) {
                            $model->out_type = 'loan_out';
                        }
                        $model->associated_disposal = $item->xszt;
                        if ($item->ckzt == 1) {
                            $model->out_status = 'unfinished';
                        }
                        if ($item->ckzt == 2) {
                            $model->out_status = 'finish';
                        }
                        $model->created_at = date('Y-m-d H:i:s', $item->addtime);
                        $model->updated_at = date('Y-m-d H:i:s', $item->edittime);
                        $model->save();
                        $model->codes()->createMany($arr);
                    }
                });
        });
        $this->info('出库管理还原完成！');
    });
}
    //条码关联
    public function barcode_associateds()
    {
        \DB::transaction(function () {
            $this->tables('tguanlian')->latest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model = new BarcodeAssociated();
                    $good = ProductGood::whereProductId($item->cplx)->whereOldid($item->cpgg)->first();
                    $admin = Admin::whereAccount($item->czry)->first();
                    if($good) {
                        $ProcurementPlan=ProcurementPlan::where(function ($query) use ($item) {
                            $query->orWhere('code', 'like', '%' .$item->tiaoma . '%')
                                ->orWhere('two_code', 'like', '%' . $item->gltm . '%');
                        })->first();
                  $WarehouseOutManagement=WarehouseOutManagement::whereHas('codes',function ($query) use ($item){
                        $query->where(function ($query) use ($item) {
                            $query->where('code', 'like', '%' .$item->tiaoma . '%');
                        });
                    })->latest()->first();
                        $default_supplier_managements=BarcodeAssociated::where(function ($query) use ($item) {
                            $query->orWhere('code', $item->gltm )
                              ->orWhere('two_code',$item->tiaoma);
                        })->first();
                        $model->supplier_managements_id=$ProcurementPlan->supplier_managements_id ?? $default_supplier_managements->supplier_managements_id ?? 0;
                        $model->procurement_plans_id=$ProcurementPlan->id ?? $default_supplier_managements->procurement_plans_id ?? 0;
                        $model->warehouse_out_management_id=$WarehouseOutManagement->id ?? $default_supplier_managements->warehouse_out_management_id ?? 0;
                        $model->order_id=$WarehouseOutManagement->order->id ?? $default_supplier_managements->order_id ?? 0;
                        $model->user_id=$WarehouseOutManagement->user->id ?? $default_supplier_managements->user_id ?? 0;
                        $model->product_good_id=$good->id ?? 0;
                        $model->current_state=config('status.barcode_associatedss')[$item->dangqianshijian];
                        $model->code=$item->tiaoma;



                        if(!empty($item->gltm) && ($item->dangqianshijian ==15 || $item->dangqianshijian ==24)){
                            $model->description="有新条码!";
                        }
                        if(!empty($item->gltm) && $item->xszt ==9 && ($item->dangqianshijian ==11 || $item->dangqianshijian ==13)){
                            $model->description="换出!";
                        }
                        if(!empty($item->gltm) && $item->xszt ==5 && $item->true == 1 && ( $item->dangqianshijian ==24 ||  $item->dangqianshijian ==16)){
                            $model->description="换进!";
                        }
                        if(!empty($item->gltm)  && $item->true ==0 && ( $item->dangqianshijian ==24 ||  $item->dangqianshijian ==15)){
                            $model->description="换出!";
                        }
//                        if(!empty($item->gltm)  && $item->true == 1 && ( $item->dangqianshijian ==24 ||  $item->dangqianshijian == 15)){
//                            $model->description="换进!";
//                        }
                        if( $item->userid ==0 && $item->ghdw ==0){
                            $model->location="库存";
                        }elseif(isset($item->userid) && !empty($item->userid) &&  $item->dangqianshijian== 12 || $item->dangqianshijian == 24 && $item->ghdw == 0){
                            $model->location="代管";
                        }elseif(isset($item->userid) && !empty($item->userid) && $item->dangqianshijian == 16 || $item->dangqianshijian == 24 && $item->ghdw != 0){
                            $model->location="供货商";
                        }elseif(isset($item->userid) and !empty($item->userid)){
                            $model->location="客户";
                        }else{
                            $model->location="供货商";
                        }
                        $model->associated_disposal=$item->xszt > 1 ? true : false;
                        $model->two_code=$item->gltm;
                        $model->product_colour=config('status.barcode_associatedss')[$item->cpcs] ?? 'new';
                        $model->postscript=$item->bzxx;
                        $model->admin=$admin->id;
                        $model->created_at = date('Y-m-d H:i:s', $item->addtime);
                        $model->updated_at = date('Y-m-d H:i:s', $item->addtime);
                        $model->save();
                    }
                });
            });
            $this->info('条码关联还原完成！');
        });
    }
    //服务管理
    public function services()
    {
        \DB::transaction(function () {
            $this->tables('zhibaoinfo')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $model=new Service();
                    $model->serial_number=$item->zhibaohao;
                    $model->order_serial_number=$item->orderhao;
                    $model->username=$item->username;
                    $model->error_description=$item->miaoshu;
                    $model->solution=$item->jjbf;
                    if($item->zbms  == 1){
                        $model->quality_assurance_model='complete_machine';
                    }
                    if($item->zbms  == 2){
                        $model->quality_assurance_model='parts';
                    }
                    if($item->zbms  == 3){
                        $model->quality_assurance_model='manual_service';
                    }
                    if($item->status  == 1){
                        $model->quality_assurance_status='quality_assurance_apply_for';
                    }
                    if($item->status  == 2){
                        $model->quality_assurance_status='quality_assurance_to_accept';
                    }
                    if($item->status  == 3){
                        $model->quality_assurance_status='quality_assurance_to_perform';
                    }
                    if($item->status  == 4){
                        $model->quality_assurance_status='quality_assurance_to_finish';
                    }
                    if($item->status  == 5){
                        $model->quality_assurance_status='no_quality_assurance';
                    }
                    if($item->zbsj  == 52){
                        $model->service_event='A';
                    }
                    if($item->zbsj  == 53){
                        $model->service_event='B';
                    }
                    if($item->zbsj  == 54){
                        $model->service_event='C';
                    }
                    if($item->zbsj  == 55){
                        $model->service_event='D';
                    }
                    if($item->zbsj  == 56){
                        $model->service_event='E';
                    }
                    if($item->time){
                        $model->created_at=date('Y-m-d H:i:s',$item->time);
                        $model->updated_at=date('Y-m-d H:i:s',$item->time);
                    }
//
                    if($item->yytime){
                        $model->door_of_time=date('Y-m-d H:i:s',strtotime($item->yytime));
                    }

                    if($item->fwry){
                        $arr['service']=Admin::whereIn('name',explode(',',$item->fwry))->pluck('account')->toArray();
                    }
                    if($item->smry){
                        $arr['door']=Admin::where('name',$item->smry)->pluck('account')->toArray();
                    }
                    if(!empty($item->tiaoma)){
                        $tiaomas=array_filter(explode(',',$item->tiaoma));
                        if(!empty($tiaomas)){
                            $model->product_goods=$tiaomas;
                        }
                    }

                    $model->door_and_service_staff=$arr;
                    $model->save();
                });
            });
            $this->info('服务管理还原完成！');
        });
    }


public
function getParameters($parts = '')
{

    $status = MemberStatus::all();
    $i = 1;
    foreach ($status as $item) {

        if ($item->type == 'customer_status') {
            $arr['order_type_code'][$i++] = $item->identifying;
        }

    }

    return $arr;
}
}

