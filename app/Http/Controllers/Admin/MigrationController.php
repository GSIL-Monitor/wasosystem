<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\BarcodeAssociated;
use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Models\Integration;
use App\Models\IntegrationCategory;
use App\Models\Menu;
use App\Models\Order;
use App\Models\ProcurementPlan;
use App\Models\Product;
use App\Models\ProductFramework;
use App\Models\ProductGood;
use App\Models\ProductParamenter;
use App\Models\WarehouseOutManagement;
use Foo\Bar\A;
use Illuminate\Http\Request;
use App\Http\Requests\AdminsRequest;
use App\Http\Controllers\Controller;
use Overtrue\Pinyin\Pinyin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class MigrationController extends Controller
{
    protected $pdo;
    protected $pdo2;
    protected $pinyin;

    public function __construct()
    {
        $this->pdo = \DB::connection('mysql2');
        $this->pdo2 = \DB::connection('mysql3');
        $this->pinyin = new Pinyin('Overtrue\Pinyin\MemoryFileDictLoader');
    }

    public function tables($table)
    {
        return $this->pdo->table($table);
    }

    public function table2($table)
    {
        return $this->pdo2->table($table);
    }

    public function run()
    {
        //手动复制的表 complete_machine_frameworks ,roles,role_has_permissions,model_has_roles,permissions
        //$this->admins();//管理员还原
        //$this->menus();//菜单还原
        //$this->roles();//角色权限还原
        // $this->products();//配件还原
        // $this->product_frameworks();//配件架构还原
        // $this->product_paramenters();//配件专有项还原
        // $this->product_goods();//配件产品还原
        //$this->self_build_product_goods();//平台自建产品还原
        //$this->complete_machines();//整机产品还原
   //     $this->integrations();//软硬一体化还原
        $this->barcode_associateds();
    }

    //条码关联
    public function barcode_associateds()
    {
        \DB::transaction(function () {
            $this->tables('tguanlian')->where('tiaoma','ZM171S033343')->latest('id')->chunk(10, function ($item) {
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
                        dump($WarehouseOutManagement);
                        $default_supplier_managements=BarcodeAssociated::where(function ($query) use ($item) {
                            $query->orWhere('code', 'like', '%' .$item->gltm . '%')
                                ->orWhere('two_code', 'like', '%' .  $item->tiaoma. '%');
                        })->first();
                        $model->supplier_managements_id=$ProcurementPlan->supplier_managements_id ?? $default_supplier_managements->supplier_managements_id ?? 0;
                        $model->procurement_plans_id=$ProcurementPlan->id ?? 0;
                        $model->warehouse_out_management_id=$WarehouseOutManagement->id ?? 0;
                        $model->order_id=$WarehouseOutManagement->order->id ?? 0;
                        $model->user_id=$WarehouseOutManagement->user->id ?? 0;
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
                       // $model->save();
                    }
                });
            });
            $this->info('条码关联还原完成！');
        });
    }
    //管理员还原
    public function admins()
    {
        \DB::transaction(function () {
            $this->tables('admin')->oldest('id')->take(10)->chunk(10, function ($item) {
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
            dump('管理员还原完成！');
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
            dump('菜单还原完成！');
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
            dump('角色还原完成！');
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
            dump('权限还原完成！');
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
            dump('配件还原完成！');
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
            dump('配件架构还原完成！');
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
            dump('配件专有项还原完成！');
        });
    }

    //产品迁移
    public function product_goods()
    {
        \DB::transaction(function () {
            //cpu
            $this->tables('cpu')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '1,2,3,4,8,5,7,10,6,9,11,12');//cpu
                    $this->create_good($item, $parameter);
                });
            });
            dump('CPU配件产品还原完成！');
            $this->tables('zhuban')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '15,13,22,14,19,16,21,18,20,17,24,23,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,42,41,43,44,45,46,47,689');//主板
                    $this->create_good($item, $parameter);
                });
            });
            dump('主板配件产品还原完成！');
            $this->tables('neicun')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '48,57,49,54,55,52,53,58,50,51,56');//内存
                    dump($this->create_good($item, $parameter));
                });
            });
            dump('内存配件产品还原完成！');
            $this->tables('yingpan')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '59,61,62,60,64,65,63,66');//硬盘
                    $this->create_good($item, $parameter);
                });
            });
            dump('硬盘配件产品还原完成！');
            $this->tables('xianka')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '75,77,79,80,76,78,81,82');//显卡
                    $this->create_good($item, $parameter);
                });
            });
            dump('显卡配件产品还原完成！');
            $this->tables('zhenlie')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '72,68,67,656,70,71,73,69,74');//阵列卡
                    $this->create_good($item, $parameter);
                });
            });
            dump('阵列卡配件产品还原完成！');
            $this->tables('wangka')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '83,86,85,87,84,88');//网卡
                    $this->create_good($item, $parameter);

                });
            });
            dump('网卡配件产品还原完成！');
            $this->tables('zhuanyong')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '89,91');//专用卡
                    $this->create_good($item, $parameter);
                });
            });
            dump('专用卡配件产品还原完成！');
            $this->tables('jixiang')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '92,93,95,96,97,101,102,99,100,98,104,105,94,103,693');//机箱
                    $this->create_good($item, $parameter);
                });
            });
            dump('机箱配件产品还原完成！');
            $this->tables('dianyuan')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '106,107,109,110,108,691,692,738');//电源
                    $this->create_good($item, $parameter);
                });
            });
            dump('电源配件产品还原完成！');
            $this->tables('sanre')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '112,113,114,115,680,684,116');//散热器
                    $this->create_good($item, $parameter);
                });
            });
            dump('散热器配件产品还原完成！');
            $this->tables('cpu')->oldest('id')->chunk(100, function ($item) {
                $item->each(function ($item, $key) {
                    $parameter = explode(',', '');//其他
                    dump($this->create_good($item, $parameter));
                });
            });
            dump('其他配件产品还原完成！');
        });

    }

    //生成产品
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
        $model->pic = explode(';', $item->a18);
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
        return $model;
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
            dump('平台自建产品还原完成！');
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
            dump('整机产品还原完成！');
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
            dump('整机产品物料还原完成！');
        });
    }

    //软硬一体化
    public function integrations()
    {

       Order::where('order_status','arrival _of_goods')->update(['order_status'=>'arrival_of_goods']);
    }
}